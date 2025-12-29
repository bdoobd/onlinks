<?php

namespace App\Core;

use Dotenv\Dotenv;
use App\Exceptions\{NotFoundException, NoAction, NoClass};
use App\Models\User;
use Throwable;

class App
{
    public static App $app;
    public static string $ROOTPATH = '';
    public Router $router;
    public Request $request;
    public Response $response;
    public DBH $db;
    public Error $errorHandler;
    public Session $session;
    public ?User $user;
    public string $url;
    public bool $isDev = false;

    public function __construct(string $rootpath)
    {
        self::$ROOTPATH = $rootpath;
        self::$app = $this;
        $this->user = null;
        $this->errorHandler = new Error();
        $this->request = new Request();
        $this->router = new Router($this->request);
        $this->url = rtrim($_SERVER['QUERY_STRING'], '\/');

        $dotenv = Dotenv::createImmutable(App::$ROOTPATH);
        $dotenv->load();

        $this->isDev = ($_ENV['DEVMODE'] ?? 'prod') === 'dev';
        $this->logDir();

        $this->db = new DBH();
        $this->session = new Session();
    }

    public function run(): void
    {
        try {
            $run = $this->router->dispatch($this->url);
            $run->send();
        } catch (Throwable $e) {
            $response = $this->errorHandler->handle($e);
            $response->send();
        }
    }

    private function logDir()
    {
        if (!file_exists(App::$ROOTPATH . '/logs')) {
            mkdir(App::$ROOTPATH . '/logs', 0760, true);
        }
    }
}
