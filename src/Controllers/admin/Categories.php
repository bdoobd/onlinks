<?php

namespace App\Controllers\admin;

use App\Core\View;
use App\Core\Response;
use App\Core\BaseController;
use App\Core\Middlewares\AuthMiddleware;
use App\Helpers\Helper;
use App\Models\Blocks;

class Categories extends BaseController
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->addMiddleware(new AuthMiddleware());
    }
    public function adminIndex(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Разделы в домашней категории');
        $view->setMeta('Блоки в категории HOME', 'index home start');

        $raw_data = Blocks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'data' => Helper::formatData($raw_data, 'BlockId', 'links', ['blockId', 'block']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
}
