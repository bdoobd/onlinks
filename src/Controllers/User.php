<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\View;
use App\Core\Request;
use App\Core\Response;
use App\Core\BaseController;
use App\Models\Login;

class User extends BaseController
{
    // public function __construct(array $route)
    // {
    //     parent::__construct($route);
    //     // $this->addMiddleware(new AuthMiddleware(['all', 'add']));
    // }
    // public function all(): Response
    // {
    //     $view = new View($this->route);
    //     $view->setTitle('List of all users');
    //     $view->setMeta('All user listing', 'users, list users, accounts');

    //     $users = ModelsUser::showAll();

    //     $data = [
    //         'users' => $users,
    //     ];

    //     $markup = $view->render($data);

    //     return new Response($markup);
    // }

    // public function add(Request $request): Response
    // {
    //     $view = new View($this->route);
    //     $view->setTitle('Register new user');
    //     $view->setMeta('Register new user', 'add new register');

    //     $user = new ModelsUser();

    //     if ($request->isPost()) {

    //         $user->loadData($request->getRequestBody());

    //         if ($user->validate() && $user->save()) {
    //             App::$app->session->setPopup('success', 'Пользователь успешно добавлен');
    //             App::$app->response->redirect('/user/all');

    //             exit();
    //         }
    //     }

    //     $data = [
    //         'model' => $user,
    //     ];

    //     $markup = $view->render($data);

    //     return new Response($markup);
    // }

    public function login(Request $request): Response
    {
        $view = new View($this->route);
        $view->setLayout('login');
        $view->setTitle('User login');
        $view->setMeta('User login page', 'login get access let me in');

        $login = new Login();

        if ($request->isPost()) {
            $login->loadData($request->getRequestBody());
            if ($login->validate() && $login->login()) {
                App::$app->response->redirect('/admin/user/all');
                exit();
            }
        }

        $data = [
            'model' => $login,
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function logout(Request $request): void
    {
        App::$app->logout();
        App::$app->response->redirect('/');

        exit();
    }
}
