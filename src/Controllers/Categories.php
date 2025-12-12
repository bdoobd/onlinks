<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\BaseController;
use App\Core\Response;
use App\Core\View;
use App\Models\Categories as ModelsCategories;
use PDO;

class Categories extends BaseController
{
    protected function mapCategoriesToActions(): array
    {
        return [
            1 => 'index',
            2 => 'blogs',
            3 => 'tech',
            4 => 'sport'
        ];
    }
    public function read(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Category section');
        // $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');


        $model = ModelsCategories::findAll();

        $data = array(
            'route' => $this->route,
            'title' => 'Category section',
            'header' => 'Categories Read Header',
            'model' => $model,
        );

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function index(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Category index');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');


        $data = [
            'info' => 'Showing category index',
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function blogs(): Response
    {
        return new Response('blog action');
    }

    public function tech(): Response
    {
        return new Response('tech action');
    }
    public function sport(): Response
    {
        return new Response('sport action');
    }
}
