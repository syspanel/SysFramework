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
 * SysLogger
 * ------------------------------------------------------------------------
 * A lightweight and flexible logging utility for SysFramework.
 * Provides configurable log levels, IP tracking, and file-based logging.
 * 
 * Features:
 *  - Customizable log file location
 *  - Adjustable verbosity level (INFO, WARNING, ERROR)
 *  - Automatic client IP detection
 *  - Timestamps and structured formatting
 * 
 * Typical use:
 *  $logger = new SysLogger();
 *  $logger->info("System started successfully");
 *  $logger->error("Failed to connect to database");
 */
class SysLogger
{
    /** @var string Path to the log file */
    protected $logFile;

    /** @var string Minimum log level */
    protected $logLevel;

    /** @var string|null Client IP address */
    protected $clientIP;

    // Log level constants for consistency and readability
    const LOG_LEVEL_INFO = 'INFO';
    const LOG_LEVEL_WARNING = 'WARNING';
    const LOG_LEVEL_ERROR = 'ERROR';

    /**
     * Constructor
     * ------------------------------------------------------------------
     * Initializes the logger with optional file path, log level, and client IP.
     * If not specified, defaults to "logs/app.log" in the parent directory.
     *
     * @param string|null $logFile   Path to the log file
     * @param string      $logLevel  Minimum level to log
     * @param string|null $clientIP  Client IP address (auto-detected if null)
     */
    public function __construct($logFile = null, $logLevel = self::LOG_LEVEL_INFO, $clientIP = null)
    {
        $this->logFile = $logFile ?: __DIR__ . '/../logs/app.log';
        $this->logLevel = $logLevel;
        $this->clientIP = $clientIP ?: $this->getClientIP();
    }

    /**
     * Write a log message to the file.
     * ------------------------------------------------------------------
     * Each message is formatted with timestamp, log level, and client IP.
     *
     * @param string $message Message to log
     * @param string $level   Log level (INFO, WARNING, ERROR)
     */
    public function log($message, $level = self::LOG_LEVEL_INFO)
    {
        if ($this->shouldLog($level)) {
            $formattedMessage = $this->formatMessage($message, $level);
            file_put_contents($this->logFile, $formattedMessage, FILE_APPEND);
        }
    }

    /**
     * Determine if a message should be logged based on log level.
     * ------------------------------------------------------------------
     * INFO < WARNING < ERROR
     *
     * @param string $level The message level
     * @return bool True if the message should be logged
     */
    protected function shouldLog($level)
    {
        $levels = [
            self::LOG_LEVEL_INFO => 1,
            self::LOG_LEVEL_WARNING => 2,
            self::LOG_LEVEL_ERROR => 3
        ];

        return $levels[$level] >= $levels[$this->logLevel];
    }

    /**
     * Format the log message.
     * ------------------------------------------------------------------
     * Generates a standardized string with timestamp, level, and IP address.
     *
     * Example:
     * [2025-10-29 14:52:11] [ERROR] [IP: 192.168.0.15] Failed to load config
     *
     * @param string $message The message to format
     * @param string $level   Log level
     * @return string Formatted message ready for file writing
     */
    protected function formatMessage($message, $level)
    {
        $timestamp = date('Y-m-d H:i:s');
        return "[$timestamp] [$level] [IP: $this->clientIP] $message" . PHP_EOL;
    }

    /**
     * Retrieve the client IP address.
     * ------------------------------------------------------------------
     * Attempts to detect IP from standard $_SERVER variables.
     *
     * @return string Detected client IP or "UNKNOWN"
     */
    protected function getClientIP()
    {
        return $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    }

    /**
     * Log an informational message.
     * ------------------------------------------------------------------
     * Used for normal operations or status messages.
     *
     * @param string $message
     */
    public function info($message)
    {
        $this->log($message, self::LOG_LEVEL_INFO);
    }

    /**
     * Log a warning message.
     * ------------------------------------------------------------------
     * Used for non-fatal issues or recoverable errors.
     *
     * @param string $message
     */
    public function warning($message)
    {
        $this->log($message, self::LOG_LEVEL_WARNING);
    }

    /**
     * Log an error message.
     * ------------------------------------------------------------------
     * Used for serious issues or system failures.
     *
     * @param string $message
     */
    public function error($message)
    {
        $this->log($message, self::LOG_LEVEL_ERROR);
    }
}
