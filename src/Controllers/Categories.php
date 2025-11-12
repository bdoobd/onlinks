<?php

namespace App\Controllers;

use App\Core\Response;
use App\Core\View;

class Categories
{
    protected array $route = [];
    public function __construct(array $route)
    {
        $this->route = $route;
    }
    public function read(): Response
    {
        // return ['first', 'second', 'third'];
        // echo 'Successfully reading data ....';
        $view = new View($this->route);

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
