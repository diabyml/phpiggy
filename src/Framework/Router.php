<?php

declare(strict_types=1);


namespace Framework;



class Router
{
    private array $routes = [];
    private array $middlewares = [];

    public function __construct()
    {
        $this->routes = [];
    }

    public function add(string $method, string $path, array $controller): void
    {
        $this->routes[] = [
            'path' => $this->normalizePath($path),
            'method' => strtoupper($method),
            'controller' => $controller
        ];
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/{$path}/";
        $path = preg_replace('#[/]{2,}#', '/', $path);
        return $path;
    }

    public function dispatch(string $path, string $method, Container $container = null)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        // echo $path . $method;

        foreach ($this->routes as $route) {
            if (!preg_match("#^{$route['path']}$#", $path) || $route['method'] !== $method) {
                continue;
            }



            // echo "route found";
            [$class, $method] = $route['controller'];
            // dd($class);
            $controllerInstance = $container ? $container->resolve($class)  :  new $class();

            $action = fn () => $controllerInstance->{$method}();

            foreach ($this->middlewares as $middleware) {
                $middlewareInstance =  $container ? $container->resolve($middleware)  : new $middleware;
                $action = fn () => $middlewareInstance->process($action);
            }

            $action();
            return;
        }
    }

    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}
