<?php

namespace App\Core;

class Router {

    protected $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get($uri, $controllerMethod) {
        $this->routes['GET'][$uri] = $controllerMethod;
    }

    public function post($uri, $controllerMethod) {
        $this->routes['POST'][$uri] = $controllerMethod;
    }

    public function dispatch($uri, $method) {
        $uri = strtok($uri, '?');

        if (!isset($this->routes[$method])) {
            echo "Method '$method' not supported.";
            return;
        }

        foreach ($this->routes[$method] as $route => $controllerMethod) {
            $routePattern = preg_replace('/\{(\w+)\}/', '(\w+)', $route);

            if (preg_match("#^$routePattern$#", $uri, $matches)) {
                list($controller, $method) = explode('@', $controllerMethod);
                $controllerClass = 'App\\Controllers\\' . $controller;
                if (class_exists($controllerClass)) {
                    $controller = new $controllerClass();

                    array_shift($matches);

                    if (method_exists($controller, $method)) {
                        call_user_func_array([$controller, $method], $matches);
                    } else {
                        echo "Method '$method' not found in '$controllerClass'.";
                    }
                } else {
                    echo "Controller class '$controllerClass' not found.";
                }
                return;
            }
        }

        echo "Route not found for URI: $uri";
    }
}