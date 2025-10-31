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
 * SysController
 * ------------------------------------------------------------------------
 * Base controller class for SysFramework applications.
 * Provides common controller utilities such as JSON response output.
 *
 * This class can be extended by application controllers to standardize
 * HTTP responses, handle request/response logic, and centralize output methods.
 */
class SysController
{
    /**
     * Sends a standardized JSON response and terminates the script.
     *
     * This method sets appropriate headers, encodes the given data into JSON,
     * outputs it to the client, and stops further PHP execution.
     * 
     * @param mixed $data        The data to be returned as a JSON response.
     * @param int   $statusCode  Optional HTTP status code (default: 200 OK).
     *
     * @return void
     *
     * @example
     * $this->jsonResponse(['status' => 'success', 'message' => 'OK']);
     */
    public function jsonResponse($data, $statusCode = 200)
    {
        // Set content type to JSON for API clients
        header('Content-Type: application/json');

        // Define the HTTP response code
        http_response_code($statusCode);

        // Convert array/object to JSON and send the response
        echo json_encode($data);

        // Immediately stop script execution after output
        exit();
    }
}
