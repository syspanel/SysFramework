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
 * SysEnv
 * ------------------------------------------------------------------------
 * Lightweight environment manager for SysFramework.
 * 
 * Provides simple `.env` file loading and retrieval of environment variables
 * in a secure and framework-consistent manner.
 * 
 * Environment variables are loaded into PHP’s `$_ENV`, `$_SERVER`,
 * and system environment (via `putenv()`), ensuring global accessibility
 * across the framework.
 */
class SysEnv
{
    /**
     * Loads environment variables from a `.env` file.
     *
     * This method reads each non-empty, non-commented line in the `.env` file,
     * parses it as `KEY=VALUE`, and exports it into PHP's environment.
     *
     * @param string $filePath Path to the `.env` file (default: one level above current directory).
     * 
     * @throws \Exception If the file does not exist or cannot be read.
     *
     * @example
     * SysEnv::load(__DIR__ . '/../.env');
     */
    public static function load($filePath = __DIR__ . '/../.env')
    {
        // Ensure the file exists before attempting to read
        if (!file_exists($filePath)) {
            throw new \Exception(".env file not found at: " . $filePath);
        }

        // Read file, ignoring empty lines and trimming whitespace
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            // Skip comment lines starting with '#'
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Parse line into key/value pair
            list($key, $value) = explode('=', $line, 2) + [NULL, NULL];

            if ($key !== NULL) {
                $key = trim($key);
                $value = trim($value);

                // Store variable in PHP superglobals and system environment
                putenv("$key=$value");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }

    /**
     * Retrieves an environment variable value.
     *
     * Checks `$_ENV`, then `$_SERVER`, returning a default value if not found.
     *
     * @param string $key     The environment variable name.
     * @param mixed  $default Default value if the key does not exist.
     * 
     * @return mixed The value of the environment variable or the default provided.
     *
     * @example
     * $dbHost = SysEnv::get('DB_HOST', 'localhost');
     */
    public static function get($key, $default = null)
    {
        return $_ENV[$key] ?? $_SERVER[$key] ?? $default;
    }
}
