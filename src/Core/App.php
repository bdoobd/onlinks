<?php

namespace App\Core;

use Dotenv\Dotenv;
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
        $this->session = new Session();
        self::$ROOTPATH = $rootpath;
        self::$app = $this;
        $this->user = null;
        $this->errorHandler = new Error();
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request);
        $this->url = rtrim($_SERVER['QUERY_STRING'], '\/');

        $dotenv = Dotenv::createImmutable(App::$ROOTPATH);
        $dotenv->load();

        $this->isDev = ($_ENV['DEVMODE'] ?? 'prod') === 'dev';
        $this->logDir();

        $this->db = new DBH();

        $foundUser = $this->session->get('user');
        if ($foundUser) {
            $this->user = User::findOne(['id' => $foundUser]);
        } else {
            $this->user = null;
        }
    }
    /**
     * Создать переменную сессии для пользователя и записать в ней данные о пользователе
     * 
     * @param User $user Данные валидированного пользователя
     * 
     * @return void
     */
    public function login(User $user): bool
    {
        $this->user = $user;
        $this->session->set('user', $user->id);

        return true;
    }
    /**
     * Удаляет данные пользователя из сессии и разлогинивает его
     * 
     * @return void
     */
    public function logout(): void
    {
        $this->user = null;
        $this->session->remove('user');
    }
    /**
     * Проверка прошёл ли пользователь аутентификацию
     * 
     * @return bool
     */
    public static function isGuest(): bool
    {
        return !self::$app->user;
    }
    /**
     * Запускает приложение, обрабатывает запросы и возвращает ответы
     * 
     * @return void
     */
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
    /**
     * Создаёт директорию для логов, если её нет
     * 
     * @return void
     */
    private function logDir()
    {
        if (!file_exists(App::$ROOTPATH . '/logs')) {
            mkdir(App::$ROOTPATH . '/logs', 0760, true);
        }
    }
}
