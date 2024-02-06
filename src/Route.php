<?php

namespace App;

use Closure;

final class Route {
    
    private array $routes = [];

    /**
     * Registers a specific route.
     * 
     * @param string $method
     * @param string $path
     * @param Closure $handler
     * @return void
     */
    public function addRoute(string $method, string $path, Closure $handler): void {
        $this->routes[$method][$path] = $handler;
    }

    /**
     * Handles and executes the route action.
     * 
     * @param string $method
     * @param string $uri
     * @return null
     */
    public function handle(string $method, string $uri): null {

        if (isset($this->routes[$method])) {

            foreach ($this->routes[$method] as $route => $handler) {
                
                $pattern = str_replace('/', '\/', $route);

                if (preg_match('/^' . $pattern . '$/', $uri, $matches)) {

                    array_shift($matches);
                    
                    return call_user_func_array($handler, $matches);
                }
            }

        }

        // @todo:- maybe extract and refactor to use Transformer/Fractal?
        http_response_code(404);

        echo json_encode(['error' => 'Route not found']);
    }
}