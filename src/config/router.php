<?php

$dispatcher = FastRoute\simpleDispatcher(require __DIR__ . '/../routes/web.php');

use App\Controllers\ErrorsController;

// Obtén el método y la URI de la solicitud
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Eliminar queryString de la URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// Despachar la solicitud
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // No se encontró ninguna ruta
        $controler = new ErrorsController();
        $controler->notFound();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        // Método no permitido
        echo "405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        
        // Instanciar y llamar al controlador y método
        [$controllerClass, $method] = $handler;
        if (class_exists($controllerClass) && method_exists($controllerClass, $method)) {
            $controller = new $controllerClass();
            call_user_func_array([$controller, $method], $vars);
        } else {
            echo "Controlador o método no encontrado";
        }
        break;
}
