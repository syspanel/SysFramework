<?php

namespace App\Controllers;

use App\Models\Client;
use Core\BaseController;
use Core\SysLogger;
use Core\SysTE;
use Core\Request;    // Adicionando a classe Request
use Core\Response;   // Adicionando a classe Response
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

    public function __construct($sysTE, $logger, $someService, $anotherService, $request, $response)
    {
        $this->sysTE = $sysTE;
        $this->logger = $logger;
        $this->someService = $someService;
        $this->anotherService = $anotherService;
        $this->request = $request;      // Injetando Request
        $this->response = $response;    // Injetando Response
    }

    public function index()
    {
        // Cria uma instância do SysLogger
        $this->logger->info('(clients.index) - Carregando lista de clientes.');

        // Obter todos os clientes
        $clients = Client::all();

        // Retornar a resposta renderizada com os dados
        return $this->response->send(
            $this->sysTE->render('clients.index', ['clients' => $clients])
        );
    }

    public function create()
    {
        return $this->response->send($this->sysTE->render('clients.create'));
    }

    public function store()
    {
        // Usar dados da requisição
        $data = $this->request->post();  // Captura os dados do POST
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        Client::create($data);

        // Redirecionar para a lista de clientes
        return $this->response->redirect('/clients');
    }

    public function edit($id)
    {
        $client = Client::find($id);

        return $this->response->send(
            $this->sysTE->render('clients.edit', ['client' => $client])
        );
    }

    public function update($id)
    {
        $data = $this->request->post();  // Captura os dados do POST
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $client = Client::find($id);
        if ($client) {
            $client->update($data);
        }

        return $this->response->redirect('/clients');
    }

    public function show($id)
    {
        $client = Client::find($id);

        return $this->response->send(
            $this->sysTE->render('clients.show', ['client' => $client])
        );
    }

    public function delete($id)
    {
        Client::destroy($id);
        
        return $this->response->redirect('/clients');
    }
}
