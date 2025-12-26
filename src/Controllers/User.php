<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Response;
use App\Core\View;
use App\Models\User as ModelsUser;

class User extends BaseController
{
    public function all(): Response
    {
        $view = new View($this->route);
        $view->setTitle('List of all users');
        $view->setMeta('All user listing', 'users, list users, accounts');

        $users = ModelsUser::showAll();

        $data = [
            'users' => $users,
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function new(): Response
    {
        return new Response('Add new user');
    }
}
