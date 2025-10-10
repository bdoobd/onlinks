<?php

namespace App\Core;

use Dotenv\Dotenv;
use App\Exceptions\NotFoundException;
use Throwable;

class App
{
    public static string $ROOTPATH = '';
    public Router $router;
    public string $url;

    public function __construct(string $rootpath)
    {
        self::$ROOTPATH = $rootpath;
        $this->router = new Router();

        $this->url = ltrim($_SERVER['REQUEST_URI'], '\/');

        $dotenv = Dotenv::createImmutable(App::$ROOTPATH);
        $dotenv->load();
    }

    public function run(): void
    {
        try {
            $this->router->dispatch($this->url);
        } catch (NotFoundException $e) {
            \App\Controllers\Error::missing($e);
        } catch (Throwable $e) {
            echo '<pre>';
            var_dump($e->getMessage());
            echo '</pre>';
        }
    }

    // TESTS, DELETE AFTER USE
    public function showURI(): string
    {
        return $this->url;
    }
}
