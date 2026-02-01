<?php

namespace App\Controllers\admin;

use App\Core\BaseController;
use App\Core\Middlewares\AuthMiddleware;
use App\Core\Response;
use App\Core\View;
use App\Helpers\Helper;
use App\Models\Blocks as ModelsBlocks;

class Blocks extends BaseController
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->addMiddleware(new AuthMiddleware());
    }

    public function adminAll(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Блоки категорий');
        $view->setMeta('Работа с блоками категорий', 'blogs all');

        $data = ModelsBlocks::runPrepQuery(Helper::createBlocksSQLString());

        $data = [
            'data' => Helper::formatDBData($data, 'catId', 'blocks', ['catId', 'cat']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
}
