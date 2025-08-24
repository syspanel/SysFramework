<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
   "driver" => $_ENV['DB_CONNECTION'],
   "host" => $_ENV['DB_HOST'],
   "database" => $_ENV['DB_DATABASE'],
   "username" => $_ENV['DB_USERNAME'],
   "password" => $_ENV['DB_PASSWORD'],
   "charset" => $_ENV['DB_CHARSET'],
   "port" => $_ENV['DB_PORT'],
   "collation" => 'utf8mb4_general_ci',
   "prefix"    => '',
]);

// Inicializa o Eloquent
$capsule->setAsGlobal();
$capsule->bootEloquent();

return $capsule;
