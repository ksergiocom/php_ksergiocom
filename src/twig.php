<?php

require_once __DIR__ . '/../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/views');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/views/cache',
    'debug' => true, // Cambiar en producción
]);