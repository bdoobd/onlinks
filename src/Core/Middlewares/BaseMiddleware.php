<?php

namespace App\Core\Middlewares;

abstract class BaseMiddleware
{
    abstract public function run(string $action);
}
