<?php

namespace App\Core\Middlewares;

use App\Core\App;
use Exception;

class AuthMiddleware extends BaseMiddleware
{
    protected array $actions;

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }
    public function run(string $action): void
    {
        if (App::isGuest()) {
            if (empty($this->actions) || in_array($action, $this->actions)) {
                App::$app->session->set('referrer', $_SERVER['REQUEST_URI']);
                App::$app->response->redirect('/user/login');
                exit();
            }
        }
    }
}
