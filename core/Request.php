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
 * Request - Handles and abstracts HTTP request data.
 *
 * This class provides an easy and secure way to access HTTP request
 * information such as method, URI, headers, GET and POST data. It is 
 * designed to centralize all request handling logic in a clean and 
 * consistent interface for controllers and middleware.
 *
 * Features:
 * - Unified access to GET, POST, and headers.
 * - Helper methods for request type checking (GET, POST, PUT, DELETE).
 * - Automatic AJAX request detection.
 * - Built-in fallback defaults for missing parameters.
 *
 * Example usage:
 * ```php
 * $request = new \Core\Request();
 * if ($request->isPost()) {
 *     $data = $request->post('username');
 * }
 * ```
 */
class Request
{
    /** @var string HTTP request method (GET, POST, PUT, DELETE, etc.) */
    protected $method;

    /** @var string Full request URI. */
    protected $uri;

    /** @var array Associative array of $_GET data. */
    protected $get;

    /** @var array Associative array of $_POST data. */
    protected $post;

    /** @var array Associative array of all request headers. */
    protected $headers;

    /**
     * Constructor.
     *
     * Initializes all core request parameters automatically.
     */
    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '/';
        $this->get = $_GET ?? [];
        $this->post = $_POST ?? [];
        $this->headers = function_exists('getallheaders') ? getallheaders() : [];
    }

    /**
     * Returns the HTTP method.
     *
     * @return string Request method (e.g., "GET", "POST").
     */
    public function method(): string
    {
        return $this->method;
    }

    /**
     * Returns the request URI.
     *
     * @return string The full request URI.
     */
    public function uri(): string
    {
        return $this->uri;
    }

    /**
     * Returns a GET parameter or all GET data.
     *
     * @param string|null $key Specific parameter name (optional).
     * @param mixed $default Default value if the key is not found.
     * @return mixed The parameter value or the entire GET array.
     */
    public function get($key = null, $default = null)
    {
        if ($key === null) {
            return $this->get;
        }
        return $this->get[$key] ?? $default;
    }

    /**
     * Returns a POST parameter or all POST data.
     *
     * @param string|null $key Specific parameter name (optional).
     * @param mixed $default Default value if the key is not found.
     * @return mixed The parameter value or the entire POST array.
     */
    public function post($key = null, $default = null)
    {
        if ($key === null) {
            return $this->post;
        }
        return $this->post[$key] ?? $default;
    }

    /**
     * Returns all HTTP headers.
     *
     * @return array List of request headers.
     */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * Returns a specific header value.
     *
     * @param string $key Header name.
     * @param mixed $default Default value if the header does not exist.
     * @return string|null Header value or default.
     */
    public function header($key, $default = null)
    {
        return $this->headers[$key] ?? $default;
    }

    /**
     * Checks whether the request was made via AJAX.
     *
     * @return bool True if it's an AJAX request, false otherwise.
     */
    public function isAjax(): bool
    {
        $xhr = $this->header('X-Requested-With');
        return !empty($xhr) && strtolower($xhr) === 'xmlhttprequest';
    }

    /**
     * Checks if the request method is POST.
     *
     * @return bool True if method is POST.
     */
    public function isPost(): bool
    {
        return $this->method === 'POST';
    }

    /**
     * Checks if the request method is GET.
     *
     * @return bool True if method is GET.
     */
    public function isGet(): bool
    {
        return $this->method === 'GET';
    }

    /**
     * Checks if the request method is PUT.
     *
     * @return bool True if method is PUT.
     */
    public function isPut(): bool
    {
        return $this->method === 'PUT';
    }

    /**
     * Checks if the request method is DELETE.
     *
     * @return bool True if method is DELETE.
     */
    public function isDelete(): bool
    {
        return $this->method === 'DELETE';
    }
}
