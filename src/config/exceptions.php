<?php

use App\Controllers\ErrorsController;

function globalExceptionHandler($exception) {
    $msg = $exception->getMessage();
    error_log($msg);
    $controlador = new ErrorsController;
    $controlador->exceptionHandler($msg);
}

set_exception_handler('globalExceptionHandler');
