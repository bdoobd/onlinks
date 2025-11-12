<?php

namespace App\Core;

use Dotenv\Dotenv;
use App\Exceptions\{NotFoundException, NoAction, NoClass};
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
            $run = $this->router->dispatch($this->url);
            $run->send();
        } catch (NotFoundException $e) {
            \App\Controllers\Error::missing($e);
        } catch (NoClass | NoAction $e) {
            \App\Controllers\Error::linkError($e);
        } catch (Throwable $e) {
            $errorResponse = new Response('Ошибка: ' . $e->getMessage(), 500);
            $errorResponse->send();
        }
    }

    // TESTS, DELETE AFTER USE
    public function showURI(): string
    {
        return $this->url;
    }
}
