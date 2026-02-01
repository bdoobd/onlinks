<?php

namespace App\Controllers\admin;

use App\Core\View;
use App\Core\Response;
use App\Core\BaseController;
use App\Core\Middlewares\AuthMiddleware;
use App\Helpers\Helper;
use App\Models\Blocks;
use App\Models\Categories as ModelsCategories;

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
            'data' => Helper::formatDBData($raw_data, 'blockId', 'links', ['blockId', 'block']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function adminBlogs(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Разделы в блогах');
        $view->setMeta('Блоки в категории BLOG', 'blog');

        $raw_data = Blocks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'data' => Helper::formatDBData($raw_data, 'blockId', 'links', ['blockId', 'block']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function adminTech(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Разделы в технике');
        $view->setMeta('Блоки в категории TECH', 'tech');

        $raw_data = Blocks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'data' => Helper::formatDBData($raw_data, 'blockId', 'links', ['blockId', 'block']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function adminSport(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Разделы в спорте');
        $view->setMeta('Блоки в категории SPORT', 'sport');

        $raw_data = Blocks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'data' => Helper::formatDBData($raw_data, 'blockId', 'links', ['blockId', 'block']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function adminAll(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Разделы категорий');
        $view->setMeta('Работа с категориями', 'categories all');

        $data = ModelsCategories::findAll();

        $data = [
            'data' => $data,
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
}
