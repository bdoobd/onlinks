<?php

namespace App\Core;

class BaseController
{
    protected array $route = [];

    public function __construct(array $route)
    {
        $this->route = $route;
    }
}
