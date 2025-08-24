<?php

namespace Core;

class Request
{
    protected $method;
    protected $uri;
    protected $get;
    protected $post;
    protected $headers;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->get = $_GET;
        $this->post = $_POST;
        $this->headers = getallheaders();
    }

    // Retorna o método HTTP (GET, POST, PUT, DELETE, etc.)
    public function method()
    {
        return $this->method;
    }

    // Retorna a URI da requisição
    public function uri()
    {
        return $this->uri;
    }

    // Retorna os dados GET
    public function get($key = null, $default = null)
    {
        if ($key === null) {
            return $this->get;
        }
        return $this->get[$key] ?? $default;
    }

    // Retorna os dados POST
    public function post($key = null, $default = null)
    {
        if ($key === null) {
            return $this->post;
        }
        return $this->post[$key] ?? $default;
    }

    // Retorna todos os headers
    public function headers()
    {
        return $this->headers;
    }

    // Retorna um header específico
    public function header($key, $default = null)
    {
        return $this->headers[$key] ?? $default;
    }

    // Verifica se é uma requisição AJAX
    public function isAjax()
    {
        return !empty($this->header('X-Requested-With')) && strtolower($this->header('X-Requested-With')) === 'xmlhttprequest';
    }

    // Verifica se o método é POST
    public function isPost()
    {
        return $this->method === 'POST';
    }

    // Verifica se o método é GET
    public function isGet()
    {
        return $this->method === 'GET';
    }

    // Verifica se o método é PUT
    public function isPut()
    {
        return $this->method === 'PUT';
    }

    // Verifica se o método é DELETE
    public function isDelete()
    {
        return $this->method === 'DELETE';
    }
}
