<?php

namespace App\Core;

use App\Core\Middlewares\BaseMiddleware;

class BaseController
{
    protected array $route = [];
    protected array $middlewares = [];

    public function __construct(array $route)
    {
        $this->route = $route;
    }

    public function addMiddleware(BaseMiddleware $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
