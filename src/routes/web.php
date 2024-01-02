<?php

use \App\Controllers\HomeController;

return function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'index']);
    $r->addRoute('GET', '/post/{_id}', [HomeController::class, 'post']);
    $r->addRoute('GET', '/about', [HomeController::class, 'about']);
};