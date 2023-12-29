<?php

use \App\Core\Router;
use \App\Controllers\HomeController;

Router::addRoute('/', [HomeController::class,'index']);