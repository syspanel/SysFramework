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
 * BaseController - Abstract foundation for all SysFramework controllers.
 *
 * Provides utility methods for returning standardized responses (JSON, redirects, etc.).
 * Controllers extending this class automatically gain access to $request and $response.
 *
 * @package SysFramework\Core
 * @author Marco Costa
 * @license MIT License
 */
abstract class BaseController
{
    /** @var \Core\Request */
    protected $request;

    /** @var \Core\Response */
    protected $response;

    /**
     * Constructor: injects Request and Response dependencies if available.
     *
     * @param Request|null  $request
     * @param Response|null $response
     */
    public function __construct(Request $request = null, Response $response = null)
    {
        $this->request = $request;
        $this->response = $response;

        // 🔹 Inicializa sessão (se ainda não iniciada)
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        // 🔹 Define locale atual (usando o da sessão ou padrão)
        if (isset($_SESSION['locale'])) {
            SysLocale::setLocale($_SESSION['locale']);
        } else {
            SysLocale::setLocale('pt-BR'); // idioma padrão
        }
    }

    /**
     * Sends a JSON response to the client.
     *
     * @param mixed $data   Data to encode.
     * @param int   $status HTTP status code.
     */
    protected function jsonResponse($data, $status = 200)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    /**
     * Sends a standardized JSON error response.
     *
     * @param string $message
     * @param int    $status
     */
    protected function jsonError($message, $status = 400)
    {
        $this->jsonResponse(['status' => 'error', 'message' => $message], $status);
    }
}

