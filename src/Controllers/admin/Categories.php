<?php

namespace App\Controllers\admin;

use App\Core\App;
use App\Core\View;
use App\Core\Request;
use App\Core\Response;
use App\Models\Blocks;
use App\Helpers\Helper;
use App\Core\BaseController;
use App\Forms\CreateCategoryForm;
use App\Forms\UpdateCategoryForm;
use App\Core\Middlewares\AuthMiddleware;
use App\Models\Categories as ModelsCategories;

class Categories extends BaseController
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->addMiddleware(new AuthMiddleware());
    }
    public function adminIndex(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Разделы в домашней категории');
        $view->setMeta('Блоки в категории HOME', 'index home start');

        $raw_data = Blocks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'data' => Helper::formatDBData($raw_data, 'blockId', 'links', ['blockId', 'block']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function adminBlogs(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Разделы в блогах');
        $view->setMeta('Блоки в категории BLOG', 'blog');

        $raw_data = Blocks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'data' => Helper::formatDBData($raw_data, 'blockId', 'links', ['blockId', 'block']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function adminTech(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Разделы в технике');
        $view->setMeta('Блоки в категории TECH', 'tech');

        $raw_data = Blocks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'data' => Helper::formatDBData($raw_data, 'blockId', 'links', ['blockId', 'block']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function adminSport(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Разделы в спорте');
        $view->setMeta('Блоки в категории SPORT', 'sport');

        $raw_data = Blocks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'data' => Helper::formatDBData($raw_data, 'blockId', 'links', ['blockId', 'block']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function adminAll(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Разделы категорий');
        $view->setMeta('Работа с категориями', 'categories all');

        $data = ModelsCategories::findAll();

        $data = [
            'data' => $data,
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function add(Request $request): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Добавить категорию');
        $view->setMeta('Добавление категории', 'categories add');

        $category = new CreateCategoryForm();

        if ($request->isPost()) {
            $category = new ModelsCategories();
            $category->loadData($request->getRequestBody());

            if ($category->validate() && $category->save()) {
                App::$app->session->setPopup('success', 'Категория успешно добавлена');
                App::$app->response->redirect('/admin/categories/admin-all');

                exit();
            }
        }

        $data = [
            'model' => $category,
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function update(Request $request): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Редактировать категорию');
        $view->setMeta('Редактирование категории', 'categories edit');

        $category = UpdateCategoryForm::findOne(['id' => $this->route['id']]);

        if ($request->isPost()) {
            $category = new ModelsCategories();
            $category->loadData($request->getRequestBody());

            if ($category->validate() && $category->update(['id' => $this->route['id']])) {
                App::$app->session->setPopup('success', 'Категория успешно обновлена');
                App::$app->response->redirect('/admin/categories/admin-all');

                exit();
            }
        }

        $data = [
            'model' => $category,
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function delete(Request $request): Response
    {
        return new Response('Delete category');
    }
}
