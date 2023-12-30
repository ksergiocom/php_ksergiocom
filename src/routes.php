<?php

use \App\Core\Router;
use \App\Controllers\HomeController;

Router::addRoute('/', [HomeController::class,'index']);
Router::addRoute('/about', [HomeController::class,'about']);