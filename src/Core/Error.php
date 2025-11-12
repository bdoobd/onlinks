<?php

namespace App\Core;

class Error
{
    private string $viewPath;

    public function __construct()
    {
        $this->viewPath = '/errors/';
    }
}
