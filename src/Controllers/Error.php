<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Response;

class Error
{
    protected array $route;
    protected string $layout = 'error';

    public function __construct(array $route = [])
    {
        $this->route = $route;
    }

    public function renderDevError(array $data): Response
    {
        $view = new View($this->route);
        $view->setLayout('error');

        $markup = $view->render($data);

        return new Response($markup);
    }
}
