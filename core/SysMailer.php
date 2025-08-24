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

class SysMailer
{
    private $host;
    private $port;
    private $username;
    private $password;
    private $encryption;
    private $fromEmail;
    private $fromName;
    private $logFile;

    public function __construct($config = [])
    {
        $this->host = $config['host'] ?? '';
        $this->port = $config['port'] ?? 587;
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->encryption = $config['encryption'] ?? 'tls';
        $this->fromEmail = $config['from_email'];
        $this->fromName = $config['from_name'];
        $this->logFile = $config['log_file'] ?? 'mail.log';
    }

    public function send($to, $subject, $body, $isHtml = true, $attachments = [], $charset = 'UTF-8')
    {
        $headers = [
            "MIME-Version: 1.1",
            "Content-type: multipart/mixed; boundary=\"=boundary\"; charset=$charset",
            "From: {$this->fromName} <{$this->fromEmail}>",
            "Return-Path: {$this->fromEmail}",
        ];

        $subject = $this->encodeSubject($subject, $charset);

        $message = implode("\r\n", $headers) . "\r\n\r\n";

        $message .= "--=boundary\r\n";
        $message .= "Content-type: text/" . ($isHtml ? 'html' : 'plain') . "; charset=$charset\r\n";
        $message .= "\r\n" . $this->encodeBody($body, $charset) . "\r\n";

        foreach ($attachments as $attachment) {
            $message .= "--=boundary\r\n";
            $message .= "Content-type: application/octet-stream; name=\"" . basename($attachment) . "\"\r\n";
            $message .= "Content-Disposition: attachment; filename=\"" . basename($attachment) . "\"\r\n";
            $message .= "Content-Transfer-Encoding: base64\r\n";
            $message .= "\r\n" . base64_encode(file_get_contents($attachment)) . "\r\n";
        }

        $message .= "--=boundary--\r\n";

        $ctx = stream_context_create([
            "ssl" => [
                "verify_peer" => true,
                "verify_peer_name" => true,
                "allow_self_signed" => false,
                "peer_name" => $this->host,
            ],
        ]);

        if ($this->encryption == 'tls') {
            $fp = fsockopen("tls://{$this->host}", $this->port, $errno, $errstr, 30);
        } elseif ($this->encryption == 'ssl') {
            $fp = fsockopen("ssl://{$this->host}", $this->port, $errno, $errstr, 30);
        } else {
            $this->logError("Método de criptografia não suportado");
            return false;
        }

        if (!$fp) {
            $this->logError("Erro ao conectar ao servidor SMTP: $errstr");
            return false;
        }

        stream_set_blocking($fp, true);

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

        $this->logSuccess("Email enviado com sucesso para $to");

        return true;
    }

    private function encodeSubject($subject, $charset)
    {
        return "=?$charset?B?" . base64_encode($subject) . "?=";
    }

    private function encodeBody($body, $charset)
    {
        return iconv($charset, 'UTF-8//IGNORE', $body);
    }

    private function logError($message)
    {
        $this->log($message, 'ERROR');
    }

    private function logSuccess($message)
    {
        $this->log($message, 'SUCCESS');
    }
    
    private function log($message, $level)
{
    $date = date('Y-m-d H:i:s');
    $log = "$date [$level] $message\r\n";
    file_put_contents($this->logFile, $log, FILE_APPEND);
}

}

?>