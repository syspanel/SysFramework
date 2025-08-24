<?php
if (!isset($_SESSION)) {
    session_start();
}

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


use App\Controllers;
use Core\SysLogger;
use Core\SysRouter;



// Definindo rotas
SysRouter::get('/', '\App\Controllers\HomeController@index')->name('home.index');
SysRouter::get('/example', '\App\Controllers\HomeController@example')->name('home.example');
SysRouter::get('/syste', '\App\Controllers\HomeController@syste')->name('home.syste');
SysRouter::get('/systable', '\App\Controllers\HomeController@systable')->name('home.systable');

SysRouter::group(['prefix' => '/clients'], function () {
    SysRouter::get('/', '\App\Controllers\ClientController@index')->name('clients.index');
    SysRouter::get('/create', '\App\Controllers\ClientController@create')->name('clients.create');
    SysRouter::post('/', '\App\Controllers\ClientController@store')->name('clients.store');
    SysRouter::get('/edit/{id}', '\App\Controllers\ClientController@edit')->name('clients.edit');
    SysRouter::put('/update/{id}', '\App\Controllers\ClientController@update')->name('clients.update');
    SysRouter::get('/show/{id}', '\App\Controllers\ClientController@show')->name('clients.show');
    SysRouter::get('/delete/{id}', '\App\Controllers\ClientController@delete')->name('clients.delete');
});


SysRouter::group(['prefix' => '/admin', 'middleware' => [AuthMiddleware::class]], function () {
    SysRouter::get('/', '\App\Controllers\AdminController@dashboard')->name('admin.dashboard');
    SysRouter::get('/users', '\App\Controllers\AdminController@users')->name('admin.users');
    SysRouter::get('/settings', '\App\Controllers\AdminController@settings')->name('admin.settings');
});



SysRouter::get('/register', '\App\Controllers\AuthController@register')->name('auth.register');
SysRouter::post('/newregister', '\App\Controllers\AuthController@newregister')->name('auth.newregister');
SysRouter::get('/registred', '\App\Controllers\AuthController@registred')->name('auth.registred');

SysRouter::get('/confirm_email', '\App\Controllers\AuthController@confirm_email')->name('auth.confirm_email');

SysRouter::get('/login', '\App\Controllers\AuthController@login')->name('auth.login');
SysRouter::post('/gologin', '\App\Controllers\AuthController@gologin')->name('auth.gologin');


SysRouter::get('/dashboard', '\App\Controllers\AuthController@dashboard')->name('auth.dashboard');

SysRouter::get('/confirmemail', '\App\Controllers\AuthController@confirmemail')->name('auth.confirmemail');
SysRouter::get('/goconfirmemail', '\App\Controllers\AuthController@goconfirmemail')->name('auth.goconfirmemail');



SysRouter::post('/send_resetlink', '\App\Controllers\AuthController@sendResetLink')->name('auth.send_resetlink');

SysRouter::get('/forgot_password', '\App\Controllers\AuthController@forgotPassword')->name('auth.forgot_password');

SysRouter::get('/reset_password', '\App\Controllers\AuthController@resetPassword')->name('auth.reset_password');

SysRouter::post('/goreset_password', '\App\Controllers\AuthController@goresetPassword')->name('auth.goreset_password');


SysRouter::get('/resend_confirmation', '\App\Controllers\AuthController@resendConfirmation')->name('auth.resend_confirmation');

SysRouter::post('/goresend_confirmation', '\App\Controllers\AuthController@goresendConfirmation')->name('auth.goresend_confirmation');





SysRouter::get('/logout', '\App\Controllers\AuthController@logout')->name('auth.logout');

// Chame o método para debugar
# SysRouter::debugRoutes();


// Rota para arquivos estáticos
SysRouter::get('/assets/{path}', function ($path) {
    $file = __DIR__ . '/../public/assets/' . $path;
    if (file_exists($file)) {
        header('Content-Type: ' . mime_content_type($file));
        readfile($file);
        exit;
    }
    http_response_code(404);
    echo "Arquivo não encontrado.";
});




// Gerando o cache das rotas
// SysRouter::cacheRoutes();

// Definindo uma rota de erro 404
SysRouter::error(function () {
    $logger = new SysLogger();

    // Obter a URL da rota atual
    $currentUrl = $_SERVER['REQUEST_URI'] ?? 'unknown';

    // Ignorar erros para recursos estáticos
    if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico)$/i', $currentUrl)) {
        // Apenas exibe uma mensagem simples sem registrar
        http_response_code(404);
        echo "Arquivo não encontrado.";
        exit;
    }

    // Registrar o erro com a URL
    $logger->warning("{$currentUrl} - Página não encontrada.");

    // Renderizar a página de erro 404
    echo '
    
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página Não Encontrada</title>
    <link rel="stylesheet" href="/assets/styles.css"> <!-- Adicione seu CSS aqui -->

<style>
/* /public/assets/styles.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    text-align: center;
    padding: 50px;
}

.container {
    max-width: 600px;
    margin: 0 auto;
}

h1 {
    font-size: 3em;
    margin-bottom: 20px;
}

p {
    font-size: 1.2em;
    margin-bottom: 20px;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 1em;
    color: #fff;
    background-color: #007bff;
    text-decoration: none;
    border-radius: 5px;
}

.button:hover {
    background-color: #0056b3;
}

</style>
</head>
<body>
    <div class="container">
        <h1>404 - Página Não Encontrada</h1>
        <p>Desculpe, a página que você está procurando não foi encontrada.</p>
        <a href="/" class="button">Voltar para a Página Inicial</a>
    </div>
</body>
</html>
';
});
