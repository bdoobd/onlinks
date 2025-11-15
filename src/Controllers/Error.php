<?php

namespace App\Controllers;

use App\Exceptions\{NotFoundException, NoClass, NoAction};
use App\Core\View;
use App\Core\Response;

class Error
{
    protected array $route = [];
    protected string $layout = 'error';

    public function __construct(array $route)
    {
        $this->route = $route;
    }

    public function renderError(array $data): Response
    {
        $view = new View();
        $view->layout = $this->layout;

        return new Response();
    }

    public function notfound(): Response
    {
        $data = [
            'controller' => 'error',
            'action' => 'notfound',
        ];

        return $this->renderError($data);
    }




    static public function missing(NotFoundException $error): void
    {
        // http_response_code($error->getCode());

        echo '<pre>';
        var_dump('resource not found, please proceed to index', $error->getCode());
        echo '</pre>';
    }

    static public function linkError(NoAction | NoClass $error): Response
    {
        $view = new View(["controller" => "Error", "action" => "linkError"]);
        $markup = $view->render();

        return new Response($markup);
    }
}
