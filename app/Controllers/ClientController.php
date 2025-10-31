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

namespace App\Controllers;

use App\Models\Client;
use Core\BaseController;
use Core\SysLogger;
use Core\SysTE;
use Core\Request;
use Core\Response;
use App\Services\AnotherService;
use App\Services\SomeService;

class ClientController extends BaseController
{
    protected $sysTE;
    protected $logger;
    protected $someService;
    protected $anotherService;
    protected $request;
    protected $response;

    /**
     * Constructor injects all dependencies: templating engine, logger,
     * services, and request/response handlers.
     */
    public function __construct($sysTE, $logger, $someService, $anotherService, $request, $response)
    {
        $this->sysTE = $sysTE;
        $this->logger = $logger;
        $this->someService = $someService;
        $this->anotherService = $anotherService;
        $this->request = $request;      // Injecting Request object
        $this->response = $response;    // Injecting Response object
    }

    /**
     * Display a list of all clients.
     */
    public function index()
    {
        $this->logger->info('(clients.index) - Loading client list.');

        $clients = Client::all(); // Fetch all clients from database

        // Render the clients list template with data
        return $this->response->send(
            $this->sysTE->render('clients.index', ['clients' => $clients])
        );
    }

    /**
     * Show the form to create a new client.
     */
    public function create()
    {
        return $this->response->send(
            $this->sysTE->render('clients.create')
        );
    }

    /**
     * Store a new client in the database.
     */
    public function store()
    {
        $data = $this->request->post();           // Get POST data
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT); // Hash password

        Client::create($data);                     // Save new client

        return $this->response->redirect('/clients'); // Redirect to client list
    }

    /**
     * Show the form to edit an existing client.
     *
     * @param int $id Client ID
     */
    public function edit($id)
    {
        $client = Client::find($id); // Find client by ID

        return $this->response->send(
            $this->sysTE->render('clients.edit', ['client' => $client])
        );
    }

    /**
     * Update an existing client in the database.
     *
     * @param int $id Client ID
     */
    public function update($id)
    {
        $data = $this->request->post();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $client = Client::find($id);
        if ($client) {
            $client->update($data); // Update client data
        }

        return $this->response->redirect('/clients');
    }

    /**
     * Show a single client's details.
     *
     * @param int $id Client ID
     */
    public function show($id)
    {
        $client = Client::find($id);

        return $this->response->send(
            $this->sysTE->render('clients.show', ['client' => $client])
        );
    }

    /**
     * Delete a client from the database.
     *
     * @param int $id Client ID
     */
    public function delete($id)
    {
        Client::destroy($id); // Delete client

        return $this->response->redirect('/clients'); // Redirect back to client list
    }
}
