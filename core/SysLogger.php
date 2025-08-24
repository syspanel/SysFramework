<?php

/************************************************************************/
/* SysFramework - PHP Framework                                         */
/* ============================                                         */
/*                                                                      */
/* PHP Framework                                                        */
/* (c) 2025 by Marco Costa marcocosta@gmx.com                           */
/*                                                                      */
/* https://sysframework.com                                             */
/*                                                                      */
/* This project is licensed under the MIT License.                      */
/*                                                                      */
/* For more informations: marcocosta@gmx.com                            */
/************************************************************************/


namespace Core;

class SysLogger
{
    protected $logFile;
    protected $logLevel;
    protected $clientIP;

    const LOG_LEVEL_INFO = 'INFO';
    const LOG_LEVEL_WARNING = 'WARNING';
    const LOG_LEVEL_ERROR = 'ERROR';

    public function __construct($logFile = null, $logLevel = self::LOG_LEVEL_INFO, $clientIP = null)
    {
        $this->logFile = $logFile ?: __DIR__ . '/../logs/app.log';
        $this->logLevel = $logLevel;
        $this->clientIP = $clientIP ?: $this->getClientIP();
    }

    public function log($message, $level = self::LOG_LEVEL_INFO)
    {
        if ($this->shouldLog($level)) {
            $formattedMessage = $this->formatMessage($message, $level);
            file_put_contents($this->logFile, $formattedMessage, FILE_APPEND);
        }
    }

    protected function shouldLog($level)
    {
        $levels = [
            self::LOG_LEVEL_INFO => 1,
            self::LOG_LEVEL_WARNING => 2,
            self::LOG_LEVEL_ERROR => 3
        ];

        return $levels[$level] >= $levels[$this->logLevel];
    }

    protected function formatMessage($message, $level)
    {
        $timestamp = date('Y-m-d H:i:s');
        return "[$timestamp] [$level] [IP: $this->clientIP] $message" . PHP_EOL;
    }

    protected function getClientIP()
    {
        return $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    }

    public function info($message)
    {
        $this->log($message, self::LOG_LEVEL_INFO);
    }

    public function warning($message)
    {
        $this->log($message, self::LOG_LEVEL_WARNING);
    }

    public function error($message)
    {
        $this->log($message, self::LOG_LEVEL_ERROR);
    }
}
