<?php

declare(strict_types=1);

namespace Framework;

class App
{

    private Router $router;
    private Container $container;

    public function __construct(string $containerDefination)
    {
        $this->router = new Router();
        $this->container = new Container();

        if ($containerDefination) {
            $containerDefinations = include $containerDefination;
            $this->container->addDefinition($containerDefinations);
        }
    }

    public function get(string $route, array $controller)
    {
        $this->router->addRoute($route, 'GET', $controller);
    }

    public function post(string $route, array $controller)
    {
        $this->router->addRoute($route, 'POST', $controller);
    }

    public function run()
    {
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method, $this->container);
    }

    public function addMiddleware(string $middleware)
    {
        $this->router->addMiddleware($middleware);
    }
}
