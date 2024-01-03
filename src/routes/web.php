<?php

use \App\Controllers\HomeController;
use \App\Controllers\AdminController;

return function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [HomeController::class, 'index']);
    $r->addRoute('GET', '/about', [HomeController::class, 'about']);

    $r->addRoute('GET', '/admin/login', [AdminController::class, 'login']);
    $r->addRoute('POST', '/admin/login', [AdminController::class, 'loginPOST']);
    $r->addRoute('GET', '/admin/register', [AdminController::class, 'register']);
    $r->addRoute('POST', '/admin/register', [AdminController::class, 'registerPOST']);
    $r->addRoute('GET', '/admin/posts/crear', [AdminController::class, 'postsCreate']);
    $r->addRoute('POST', '/admin/posts/crear', [AdminController::class, 'postsCreatePOST']);

    $r->addRoute('GET', '/post/{_id}', [HomeController::class, 'post']);
};