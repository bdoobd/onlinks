<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\View;
use App\Core\Response;

class Error extends BaseController
{
    protected string $layout = 'error';

    public function renderDevError(array $data): Response
    {
        $view = new View($this->route);
        $view->setLayout('error');

        $markup = $view->render($data);

        return new Response($markup);
    }
}
