<?php

namespace App\Controllers;

use App\Core\BaseController;

class ErrorsController extends BaseController {
    public function notFound() {
        $this->render('errors/404.twig');
    }

    public function exceptionHandler($message) {
        $this->render('errors/500.twig', ['message' => $message]);
    }
}