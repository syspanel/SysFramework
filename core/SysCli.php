<?php

/***************************************************************************
 * SysFramework - PHP Framework                                            *
 * ======================================================================= *
 *                                                                          *
 * PHP Framework                                                            *
 * (c) 2025 Marco Costa  |  sysframework@syspanel.com.br                    *
 * Website: https://sysframework.syspanel.com.br                            *
 *                                                                          *
 * Licensed under the MIT License                                           *
 *                                                                          *
 * Permission is hereby granted, free of charge, to any person obtaining    *
 * a copy of this software and associated documentation files (the          *
 * "Software"), to deal in the Software without restriction, including      *
 * without limitation the rights to use, copy, modify, merge, publish,      *
 * distribute, sublicense, and/or sell copies of the Software, and to       *
 * permit persons to whom the Software is furnished to do so, subject to    *
 * the following conditions:                                                *
 *                                                                          *
 * The above copyright notice and this permission notice shall be included  *
 * in all copies or substantial portions of the Software.                   *
 *                                                                          *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS  *
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF               *
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.   *
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY     *
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,     *
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE        *
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                   *
 ***************************************************************************/

namespace Core;

/**
 * Class SysCli
 * -------------------------------------------------------------------------
 * Provides a secure interface for executing system commands, managing 
 * database dumps, and running PHP’s built-in development server.
 * 
 * This class is designed to ensure command-line operations are safe by
 * escaping arguments and preventing command injection vulnerabilities.
 * 
 * Typical use cases include:
 *  - Running safe shell commands
 *  - Automating MySQL dumps without exposing credentials
 *  - Launching PHP’s built-in web server
 * 
 * @package SysFramework\Core
 * @since 1.0.0
 * @see Core\Security
 * @see Core\Response
 */
class SysCli
{
    /**
     * Registered command list (reserved for future CLI command management)
     * @var array
     */
    protected array $commands = [];

    public function __construct()
    {
        // Reserved for CLI initialization if needed in the future
    }

    /**
     * Executes a shell command securely with escaped arguments.
     * Uses proc_open to capture both stdout and stderr streams.
     *
     * @param string $cmd  The base command (e.g., "ls" or "php")
     * @param array  $args Optional arguments for the command
     * @return array Returns an associative array with keys:
     *               - 'status' => exit code
     *               - 'output' => stdout content
     *               - 'error'  => stderr content
     *               - 'cmd'    => the executed command line
     * @throws \RuntimeException if command execution fails
     */
    protected function runShellCommand(string $cmd, array $args = []): array
    {
        $safeArgs = array_map('escapeshellarg', $args);
        $full = $cmd . ' ' . implode(' ', $safeArgs);

        // Define pipes for stdout and stderr
        $descriptors = [
            1 => ['pipe', 'w'], // stdout
            2 => ['pipe', 'w'], // stderr
        ];

        $process = proc_open($full, $descriptors, $pipes);
        $output = '';
        $error = '';

        if (is_resource($process)) {
            $output = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            $error = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
            $status = proc_close($process);
        } else {
            throw new \RuntimeException("Unable to execute command");
        }

        return [
            'status' => $status,
            'output' => $output,
            'error'  => $error,
            'cmd'    => $full
        ];
    }

    /**
     * Runs a safe MySQL database dump (mysqldump) without exposing
     * credentials on the command line.
     *
     * Creates a temporary protected defaults file for MySQL credentials
     * when one is not provided, then executes mysqldump securely.
     *
     * @param array  $dbConfig  Array with keys:
     *                          'host', 'user', 'password', 'database', optional 'defaults-file'
     * @param string $dumpFile  Path to output dump file
     * @return array  Result array similar to runShellCommand()
     */
    public function mysqldump(array $dbConfig, string $dumpFile): array
    {
        if (empty($dbConfig['defaults-file'])) {
            // Create temporary protected file for credentials
            $tmp = tempnam(sys_get_temp_dir(), 'mycnf_');
            $content = "[client]\nuser={$dbConfig['user']}\npassword={$dbConfig['password']}\nhost={$dbConfig['host']}\n";
            file_put_contents($tmp, $content);
            chmod($tmp, 0600);
            $defaultsArg = '--defaults-extra-file=' . $tmp;
        } else {
            $defaultsArg = '--defaults-extra-file=' . escapeshellarg($dbConfig['defaults-file']);
            $tmp = null;
        }

        $cmd = 'mysqldump';
        $args = [$defaultsArg, $dbConfig['database'], '>', $dumpFile];

        // Build full command safely (with redirection support)
        $full = $cmd . ' ' . implode(' ', array_map(
            fn($a) => is_string($a) ? $a : escapeshellarg($a),
            $args
        ));

        // Execute using shell for redirection
        $proc = proc_open($full, [['pipe', 'r'], ['pipe', 'w'], ['pipe', 'w']], $pipes);
        if (is_resource($proc)) {
            $out = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            $err = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
            $status = proc_close($proc);
        } else {
            $out = '';
            $err = 'proc_open failed';
            $status = 1;
        }

        if ($tmp) {
            @unlink($tmp); // Clean up temporary credentials file
        }

        return [
            'status' => $status,
            'output' => $out,
            'error'  => $err,
            'cmd'    => $full
        ];
    }

    /**
     * Launches PHP’s built-in development server securely.
     *
     * Useful for local testing or rapid prototyping without a full web server.
     *
     * @param string $host    The hostname or IP address to bind to (default: 127.0.0.1)
     * @param int    $port    The port number to listen on (default: 8000)
     * @param string $docroot The document root directory (default: 'public')
     * @return array  Result array with command output and status
     */
    public function serve(string $host = '127.0.0.1', int $port = 8000, string $docroot = 'public'): array
    {
        $cmd = PHP_BINARY;
        $args = ['-S', "{$host}:{$port}", '-t', $docroot];
        return $this->runShellCommand($cmd, $args);
    }

    /**
     * Generic command execution helper.
     *
     * Safely executes a system command with properly escaped arguments.
     * Equivalent to calling runShellCommand() directly.
     *
     * @param string $command The command to execute
     * @param array  $args    Optional array of arguments
     * @return array  Same structure as runShellCommand()
     */
    public function execCommand(string $command, array $args = []): array
    {
        return $this->runShellCommand($command, $args);
    }
}
