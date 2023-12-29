<?php

namespace App\Core;

abstract class BaseController {
    protected $twig;

    public function __construct() {
        // Inicializar Twig
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => __DIR__ . '/../views/cache',
            'debug' => true, // Cambiar en producción
        ]);
    }

    protected function render($view, array $data = []) {
        echo $this->twig->render($view, $data);
    }
}