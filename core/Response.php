<?php

namespace Core;

class Response
{
    protected $statusCode = 200;
    protected $headers = [];

    // Define o código de status da resposta
    public function setStatusCode(int $code)
    {
        $this->statusCode = $code;
        http_response_code($code);
        return $this;
    }

    // Adiciona um header à resposta
    public function addHeader(string $name, string $value)
    {
        $this->headers[$name] = $value;
        header("$name: $value");
        return $this;
    }

    // Envia o conteúdo HTML como resposta
    public function send($content)
    {
        // Envia todos os headers
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        echo $content;
        return $this;
    }

    // Redireciona para outra URL
    public function redirect($url)
    {
        $this->setStatusCode(302);
        header('Location: ' . $url);
        exit();
    }

    // Define o tipo de conteúdo
    public function setContentType($type = 'text/html')
    {
        $this->addHeader('Content-Type', $type);
        return $this;
    }
}
