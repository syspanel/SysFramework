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
 * SysMailer
 * ------------------------------------------------------------------------
 * A lightweight SMTP mailer for SysFramework.
 *
 * Features:
 *  - Supports TLS and SSL
 *  - Supports attachments
 *  - Logs sending success or errors to a log file
 *  - Handles subject encoding and charset conversion
 *
 * Example usage:
 *  $mailer = new SysMailer([
 *      'host' => 'smtp.example.com',
 *      'port' => 587,
 *      'username' => 'user@example.com',
 *      'password' => 'secret',
 *      'encryption' => 'tls',
 *      'from_email' => 'user@example.com',
 *      'from_name' => 'Example User',
 *      'log_file' => 'mail.log'
 *  ]);
 *  $mailer->send('recipient@example.com', 'Hello', '<b>Hi!</b>');
 */
class SysMailer
{
    /** @var string SMTP host */
    private $host;

    /** @var int SMTP port */
    private $port;

    /** @var string SMTP username */
    private $username;

    /** @var string SMTP password */
    private $password;

    /** @var string Encryption method: tls|ssl */
    private $encryption;

    /** @var string Sender email */
    private $fromEmail;

    /** @var string Sender name */
    private $fromName;

    /** @var string Log file path */
    private $logFile;

    /**
     * Constructor
     *
     * Initializes SMTP configuration and log file.
     *
     * @param array $config SMTP settings: host, port, username, password, encryption, from_email, from_name, log_file
     */
    public function __construct($config = [])
    {
        $this->host = $config['host'] ?? '';
        $this->port = $config['port'] ?? 587;
        $this->username = $config['username'] ?? '';
        $this->password = $config['password'] ?? '';
        $this->encryption = $config['encryption'] ?? 'tls';
        $this->fromEmail = $config['from_email'] ?? '';
        $this->fromName = $config['from_name'] ?? '';
        $this->logFile = $config['log_file'] ?? 'mail.log';
    }

    /**
     * Send an email
     *
     * @param string $to Recipient email
     * @param string $subject Email subject
     * @param string $body Email body
     * @param bool $isHtml True for HTML content, false for plain text
     * @param array $attachments Array of file paths to attach
     * @param string $charset Character set, default UTF-8
     * @return bool True if email sent successfully
     */
    public function send($to, $subject, $body, $isHtml = true, $attachments = [], $charset = 'UTF-8')
    {
        // Build headers
        $headers = [
            "MIME-Version: 1.1",
            "Content-type: multipart/mixed; boundary=\"=boundary\"; charset=$charset",
            "From: {$this->fromName} <{$this->fromEmail}>",
            "Return-Path: {$this->fromEmail}",
        ];

        $subject = $this->encodeSubject($subject, $charset);

        $message = implode("\r\n", $headers) . "\r\n\r\n";

        // Add message body
        $message .= "--=boundary\r\n";
        $message .= "Content-type: text/" . ($isHtml ? 'html' : 'plain') . "; charset=$charset\r\n";
        $message .= "\r\n" . $this->encodeBody($body, $charset) . "\r\n";

        // Add attachments
        foreach ($attachments as $attachment) {
            $message .= "--=boundary\r\n";
            $message .= "Content-type: application/octet-stream; name=\"" . basename($attachment) . "\"\r\n";
            $message .= "Content-Disposition: attachment; filename=\"" . basename($attachment) . "\"\r\n";
            $message .= "Content-Transfer-Encoding: base64\r\n";
            $message .= "\r\n" . base64_encode(file_get_contents($attachment)) . "\r\n";
        }

        $message .= "--=boundary--\r\n";

        // Connect to SMTP server
        if ($this->encryption == 'tls') {
            $fp = fsockopen("tls://{$this->host}", $this->port, $errno, $errstr, 30);
        } elseif ($this->encryption == 'ssl') {
            $fp = fsockopen("ssl://{$this->host}", $this->port, $errno, $errstr, 30);
        } else {
            $this->logError("Unsupported encryption method");
            return false;
        }

        if (!$fp) {
            $this->logError("SMTP connection failed: $errstr");
            return false;
        }

        stream_set_blocking($fp, true);

        // SMTP handshake and email sending
        fwrite($fp, "HELO {$this->host}\r\n");
        fwrite($fp, "AUTH LOGIN\r\n");
        fwrite($fp, base64_encode($this->username) . "\r\n");
        fwrite($fp, base64_encode($this->password) . "\r\n");
        fwrite($fp, "MAIL FROM: <{$this->fromEmail}>\r\n");
        fwrite($fp, "RCPT TO: <$to>\r\n");
        fwrite($fp, "DATA\r\n");
        fwrite($fp, $message . "\r\n.\r\n");
        fwrite($fp, "QUIT\r\n");

        fclose($fp);

        $this->logSuccess("Email successfully sent to $to");

        return true;
    }

    /**
     * Encode subject to base64 for proper charset support
     */
    private function encodeSubject($subject, $charset)
    {
        return "=?$charset?B?" . base64_encode($subject) . "?=";
    }

    /**
     * Encode message body according to charset
     */
    private function encodeBody($body, $charset)
    {
        return iconv($charset, 'UTF-8//IGNORE', $body);
    }

    /**
     * Log error messages
     */
    private function logError($message)
    {
        $this->log($message, 'ERROR');
    }

    /**
     * Log successful messages
     */
    private function logSuccess($message)
    {
        $this->log($message, 'SUCCESS');
    }

    /**
     * Write message to log file
     */
    private function log($message, $level)
    {
        $date = date('Y-m-d H:i:s');
        $log = "$date [$level] $message\r\n";
        file_put_contents($this->logFile, $log, FILE_APPEND);
    }
}
