<?php

require_once "vendor/autoload.php";

global $config;

$config = json_decode(file_get_contents('config.json'));

ORM::configure($config->orm->string);
ORM::configure('username', $config->orm->username);
ORM::configure('password', $config->orm->password);
Model::$short_table_names = true;

\Assman\Controller\Labels::hookIn();
\Assman\Controller\Api::hookIn();

Flight::start();