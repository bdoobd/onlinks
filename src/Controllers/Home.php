<?php

namespace App\Controllers;

use App\Core\Response;
use App\Core\View;

class Home

{
    protected array $route = [];

    public function __construct(array $route)
    {
        $this->route = $route;
    }
    public function index(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Home Page Title');

        $data = array(
            'route' => $this->route,
            'title' => 'Here is my title',
        );


        $markup = $view->render($data);

        return new Response($markup);
    }
}
