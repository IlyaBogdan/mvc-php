<?php

namespace kernel;

use Exception;

/**
 * Main router
 * 
 * @property array $routes
 */
class Router 
{
    private array $routes;

    public function __construct()
    {
        $this->routes = require_once dirname(__FILE__) . '/../src/routes/routes.php';
    }

    public function dispatch(string $url, string $method): void
    {
        foreach ($this->routes as $route => $methods) {
            $routePattern = $this->convertRouteToRegex($route);
            if (preg_match($routePattern, $url, $matches)) {
                if (isset($methods[$method])) {
                    $this->mountController($methods[$method], $matches);
                    return;
                } else {
                    throw new Exception("Not found route with method {$method} for url {$url}");
                }
            }
        }

        throw new Exception('Not found');
    }

    private function convertRouteToRegex($route): string
    {
        $pattern = preg_replace('/<\w+>/', '(\w+)', $route);
        return '@^' . $pattern . '$@';
    }

    private function mountController(array $routeConfig, $matches): void
    {
        list($controller, $action) = $routeConfig;
        $params = array_slice($matches, 1);
        $this->getController($controller);

        $controllerInstance = new $controller();
        call_user_func_array([$controllerInstance, $action], $params);
    }

    private function getController(string $controllerClass): void
    {
        $controllerFile = APP_ROOT . '/src/' . $controllerClass . '.php';
        if (!file_exists($controllerFile)) throw new Exception("Controller {$controllerClass} not found");
        require_once $controllerFile;
    }
}