<?php

include __DIR__ . '/../../vendor/autoload.php';
include __DIR__ . '/../routes.php';

use App\Core\Router;

$router = new Router();
$router->dispatch();