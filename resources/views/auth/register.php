<?php

require_once '../vendor/autoload.php';
use App\Controllers\AuthController;

$controller = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = $controller->register((object) $_POST);
    // Trate a resposta (ex.: redirecionar ou exibir mensagem)
    if (isset($response['errors'])) {
        // Exibir erros
    } else {
        // Redirecionar ou exibir mensagem de sucesso
    }
}
