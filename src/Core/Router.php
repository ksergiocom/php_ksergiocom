<?php

namespace App\Core;

use \App\Controllers;

class Router {
    // Rutas guardadas en el router
    protected static $routes = [];

    
    // Método estático para agregar rutas
    public static function addRoute(string $url, $handler) {
        self::$routes[$url] = $handler;
    }

    // Metodo para hacer escuchar el router a los requests y despacharlos
    public function dispatch(){

        $url = $_SERVER['REQUEST_URI'] ?? '/';
        if(isset(self::$routes[$url])){
            $this->callHandler(self::$routes[$url]);
        } else {
            echo "404 Not Found";
        }
    }

    // Metodo para ejecutar el controlador asociado a la ruta
    protected function callHandler($handler) {
        if (is_array($handler) && count($handler) === 2) {
            [$controller, $method] = $handler;
    
            if (class_exists($controller) && method_exists($controller, $method)) {
                $controllerInstance = new $controller();
                $controllerInstance->$method();
            } else {
                echo "Controlador o método no encontrado";
            }
        }
    }
}