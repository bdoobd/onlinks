<?php

namespace App\Controllers\admin;

use App\Core\App;
use App\Core\View;
use App\Core\Request;
use App\Core\Response;
use App\Core\BaseController;
use App\Forms\UpdatePasswordForm;
use App\Models\User as ModelsUser;
use App\Core\Middlewares\AuthMiddleware;
use App\Forms\CreateUserForm;

class User extends BaseController
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->addMiddleware(new AuthMiddleware());
    }
    public function all(): Response
    {
        $view = new View($this->route);
        $view->setLayout(layout: 'admin');
        $view->setTitle('Список всех пользователей');
        $view->setMeta('Выборка всех пользователей', 'users, list users, accounts');

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
        $view->setLayout(layout: 'admin');

        $view->setTitle('Создать нового пользователя');
        $view->setMeta('Создание нового пользователя', 'add new register');

        $user = new CreateUserForm();

        if ($request->isPost()) {

            $user->loadData($request->getRequestBody());

            if ($user->validate() && $user->save()) {
                App::$app->session->setPopup('success', 'Пользователь успешно добавлен');
                App::$app->response->redirect('/admin/user/all');

                exit();
            }
        }

        $data = [
            'model' => $user,
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function edit(Request $request): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Сменить пароль пользователя');
        $view->setMeta('Изменение пароля пользователя', 'edit modify password');

        $user = ModelsUser::findOne(['id' => $this->route['id']]);
        $data = [
            'user' => $user->name,
            'current_password' => true,
        ];
        $form_data = new UpdatePasswordForm();


        if ($request->isPost()) {
            $form_data->loadData($request->getRequestBody());
            $data['current_password'] = password_verify($form_data->current_password, $user->pwd);
            $form_data->id = $this->route['id'];

            if ($form_data->validate() && $data['current_password'] && $form_data->save()) {
                App::$app->session->setPopup('success', 'Пароль для пользователя успешно обновлён');
                App::$app->response->redirect('/admin/user/all');

                exit();
            }
        }

        $data['model'] = $form_data;

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function delete(Request $request): Response
    {
        $user = ModelsUser::findOne(['id' => $this->route['id']]);

        if ($user->delete(['id' => $this->route['id']])) {
            App::$app->session->setPopup('success', 'Пользователь успешно удалён');
        } else {
            App::$app->session->setPopup('warning', 'Произошла ошибка при удалении пользователя');
        }

        App::$app->response->redirect('/admin/user/all');

        exit();
    }
}
