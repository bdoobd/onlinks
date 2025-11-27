<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Response;
use App\Core\View;

class Categories extends BaseController
{
    public function read(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Category section');

        $data = array(
            'route' => $this->route,
            'title' => 'Category section',
            'header' => 'Categories Read Header'
        );

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function add(): int
    {
        return 5;
    }

    public function edit(): void
    {
        echo "Edit success";
    }

    public function delete(): void
    {
        echo 'Delete success';
    }
}
