<?php

namespace App\Core;

class App
{
    public Router $router;
    public string $url;

    public function __construct(string $rootpath)
    {
        $this->router = new Router();
        $this->url = ltrim($_SERVER['REQUEST_URI'], '\/');
    }

    public function run(): void
    {
        $this->router->dispatch($this->url);
    }

    // TESTS, DELETE AFTER USE
    public function showURI(): void
    {
        echo '<pre>';
        var_dump($this->url);
        echo '</pre>';
        // die();
    }
}
