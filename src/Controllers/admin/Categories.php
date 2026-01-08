<?php

namespace App\Controllers\admin;

use App\Core\View;
use App\Core\Response;
use App\Core\BaseController;
use App\Core\Middlewares\AuthMiddleware;

class Categories extends BaseController
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->addMiddleware(new AuthMiddleware());
    }

    public function home(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Разделы в домашней категории');
        $view->setMeta('Блоки в категории HOME', 'index home start');

        $data = [
            'data' => 'Home page of admin section',
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
}
