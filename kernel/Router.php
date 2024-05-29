<?php

namespace kernel;

use Exception;

class Router 
{
    private array $routes;

    public function __construct()
    {
        $this->routes = require_once dirname(__FILE__) . '/../src/routes/routes.php';
    }

    public function dispatch($url) 
    {
        $url = trim($url, '/');

        $this->bindRoute($url);
    }

    private function mountController(string $controllerClass, string $methodName): void
    {
        $controllerFile = APP_ROOT . '/src/' . $controllerClass . '.php';
        if (!file_exists($controllerFile)) throw new Exception("Controller {$controllerClass} not found");
        require_once $controllerFile;
        $controller = new $controllerClass();
        if (!method_exists($controller, $methodName)) throw new Exception("Method {$methodName} not found");
        
        $controller->$methodName();
    }

    private function bindRoute(string $url): void
    {
        $routeKey = '/' . $url;
        if (!array_key_exists($routeKey, $this->routes)) throw new Exception('Not found');
        if (!array_key_exists($_SERVER['REQUEST_METHOD'], $this->routes[$routeKey])) throw new Exception("Not found route with method {$_SERVER['REQUEST_METHOD']} for url {$url}");
        list($controllerClass, $methodName) = $this->routes[$routeKey][$_SERVER['REQUEST_METHOD']];
        $this->mountController($controllerClass, $methodName);
    }
}