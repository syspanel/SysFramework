<?php
if (!isset($_SESSION)) {
    session_start();
}

/************************************************************************/
/* SysFramework - PHP Framework                                         */
/* ============================                                         */
/*                                                                      */
/* Version 1.0                                                          */
/*                                                                      */
/* PHP Framework                                                        */
/* (c) 2025 by Marco Costa                                              */
/*                                                                      */
/* https://sysframework.com                                 */
/*                                                                      */
/* Syspanel is Registered with the Brazil INPI under                    */
/* number RS 091525 - 02/02/2010.                                       */
/*                                                                      */
/* Unauthorized reproduction. Copy and distribuition are not allowed.   */
/*                                                                      */
/* For more informations: marcocosta@sysframework.com.br                */
/************************************************************************/

use Core\SysSanitize;
use App\Services\SomeService;
use App\Services\AnotherService;
use Core\SysLogger;
use Core\SysRouter;
use Core\SysTE;
use GuzzleHttp\Psr7;
use DI\Container;
use Core\Library\Session;




require_once dirname(__DIR__) . '/config/helpers.php';
$paths = require dirname(__DIR__) . '/config/paths.php';
require_once dirname(__DIR__) . '/config/loadenv.php';
require_once dirname(__DIR__) . '/config/settings.php';

sanitizeMiddleware();



// Configuração do banco de dados Illuminate
# $capsule = require __DIR__ . '/../config/database.php';



// Router

/* Load external routes file */
require dirname(__DIR__) . '/routes/web.php';

// Lendo cache das rotas
#SysRouter::loadRoutesFromCache();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Criação das instâncias de Request e Response
$request = new \Core\Request(); // Instância de Request
$response = new \Core\Response(); // Instância de Response

// Dependências a serem injetadas no controlador
$dependencies = [
    new SysTE(VIEWS_PATH, VIEWSCACHE_PATH),
    new SysLogger(),
    new SomeService(),
    new AnotherService(),
    $request,    // Adicionando a instância de Request
    $response    // Adicionando a instância de Response
];

// Resolve a rota e injeta as dependências
SysRouter::resolve($requestMethod, $requestUri, $dependencies);

#Session::remove_flash();
