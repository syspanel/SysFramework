<?php  
if (!isset($_SESSION)) { session_start(); }

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


return [
    // Caminho raiz do projeto
    'base_path' => dirname(__DIR__),

    // Diretórios principais
    'app_path' => dirname(__DIR__) . '/app',
    'core_path' => dirname(__DIR__) . '/core',
    'public_path' => dirname(__DIR__) . '/public',
    'routes_path' => dirname(__DIR__) . '/routes',
    'storage_path' => dirname(__DIR__) . '/storage',
    'config_path' => dirname(__DIR__) . '/config',

    // Subdiretórios específicos
    'controllers_path' => dirname(__DIR__) . '/app/Controllers',
    'models_path' => dirname(__DIR__) . '/app/Models',
    'views_path' => dirname(__DIR__) . '/resources/views',
    'helpers_path' => dirname(__DIR__) . '/app/Helpers',
    'events_path' => dirname(__DIR__) . '/app/Events',
    'listeners_path' => dirname(__DIR__) . '/app/Listeners',
    'middlewares_path' => dirname(__DIR__) . '/app/Middlewares',
    'services_path' => dirname(__DIR__) . '/app/Services',
    'usecases_path' => dirname(__DIR__) . '/app/UseCases',
    'console_path' => dirname(__DIR__) . '/app/Console',

    'cache_path' => dirname(__DIR__) . '/cache',
    'viewscache_path' => dirname(__DIR__) . '/cache/views',
    'logs_path' => dirname(__DIR__) . '/logs',
    'uploads_path' => dirname(__DIR__) . '/storage/uploads',

    // Arquivo de rotas
    'webroutes_file' => dirname(__DIR__) . '/routes/web.php',


    // Arquivo de ambiente
    'env_file' => dirname(__DIR__) . '/.env',
];

