<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Response;
use App\Core\View;

class Home extends BaseController
{
    public function index(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Home Page Title');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');

        $data = array(
            'route' => $this->route,
            'title' => 'Here is my title',
        );


        $markup = $view->render($data);

        return new Response($markup);
    }
}
