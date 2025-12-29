<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\View;
use App\Core\Request;
use App\Core\Response;
use App\Core\BaseController;
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

    public function add(Request $request): Response
    {
        $view = new View($this->route);
        $view->setTitle('Register new user');
        $view->setMeta('Register new user', 'add new register');

        $data = [
            'register' => 'register',
        ];

        if ($request->isPost()) {
            $user = new ModelsUser();

            $user->loadData($request->getRequestBody());

            $data['formData'] = $user;
        }

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function login(): Response
    {
        $view = new View($this->route);
        $view->setTitle('User login');
        $view->setMeta('User login page', 'login get access let me in');

        $data = [
            'login' => 'loginForm',
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
}
