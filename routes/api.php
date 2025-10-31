<?php

// Definindo rotas para a API versão 1
Router::group('/api/v1', function() {
    Router::get('/users', '\App\Controllers\Api\ApiUserController@index');
    Router::get('/users/{id}', '\App\Controllers\Api\ApiUserController@show');
    Router::post('/users', '\App\Controllers\Api\ApiUserController@store');
    Router::put('/users/{id}', '\App\Controllers\Api\ApiUserController@update');
    Router::delete('/users/{id}', '\App\Controllers\Api\ApiUserController@delete');
});
