<?php

namespace Core;

class Router
{
    private $routes = [];

    public function add(string $route, callable $callback): void
    {
        $this->routes[$route] = $callback;
    }

    public function dispatch(string $url): void
    {
        if (array_key_exists($url, $this->routes)) {
            call_user_func($this->routes[$url]);
        } else {
            http_response_code(404);
            echo '404 - Not Found';
        }
    }
}