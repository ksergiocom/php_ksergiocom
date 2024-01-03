<?php

use \App\Controllers\HomeController;
use \App\Controllers\AdminController;

return function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'index']);
    $r->addRoute('GET', '/about', [HomeController::class, 'about']);
    $r->addRoute('GET', '/admin/login', [AdminController::class, 'login']);
    $r->addRoute('GET', '/post/{_id}', [HomeController::class, 'post']);
};