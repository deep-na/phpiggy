<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    public function addRoute(string $route, string $method, array $controller)
    {
        $route = $this->normalisePath($route);
        $this->routes[] = [
            "path" => $route,
            "method" => strtoupper($method),
            "controller" => $controller
        ];
    }

    private function normalisePath(string $path): string
    {
        $path = trim($path, "/");
        $path =  "/{$path}/";
        $path = preg_replace('#[/]{2,}#', '/', $path);
        return $path;
    }


    public function dispatch(string $route, string $method, Container $container)
    {

        $route = $this->normalisePath($route);
        $method = strtoupper($method);

        foreach ($this->routes as $path) {

            if (!preg_match("#^{$path['path']}$#", $route) || $path['method'] !== $method) {

                continue;
            }

            [$class, $pMethod] = $path['controller'];

            $controller = $container ? $container->resolve($class) : new $class;

            $action = fn () => $controller->$pMethod();

            foreach ($this->middlewares as $middleware) {
                $middlewareInstance = $container ? $container->resolve($middleware) : new $middleware;
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
