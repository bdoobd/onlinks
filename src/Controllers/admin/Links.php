<?php

namespace App\Controllers\admin;

use App\Core\App;
use App\Core\BaseController;
use App\Core\Middlewares\AuthMiddleware;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Forms\CreateLinkForm;
use App\Forms\UpdateLinkForm;
use App\Helpers\Helper;
use App\Models\Blocks;
use App\Models\Links as ModelsLinks;

class Links extends BaseController
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
        $view->setTitle('Ссылки в категории HOME');
        $view->setMeta('Ссылки в категории HOME', 'index home start');

        $raw_data = ModelsLinks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'data' => Helper::formatDBData($raw_data, 'blockId', 'links', ['blockId', 'block', 'catId']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function adminBlogs(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Ссылки в категории BLOGS');
        $view->setMeta('Ссылки в категории BLOGS', 'index blogs start');

        $raw_data = ModelsLinks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);
        $data = [
            'data' => Helper::formatDBData($raw_data, 'blockId', 'links', ['blockId', 'block', 'catId']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function adminTech(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Ссылки в категории TECH');
        $view->setMeta('Ссылки в категории TECH', 'index tech start');

        $raw_data = ModelsLinks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);
        $data = [
            'data' => Helper::formatDBData($raw_data, 'blockId', 'links', ['blockId', 'block', 'catId']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function adminSport(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Ссылки в категории SPORT');
        $view->setMeta('Ссылки в категории SPORT', 'index sport start');

        $raw_data = ModelsLinks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);
        $data = [
            'data' => Helper::formatDBData($raw_data, 'blockId', 'links', ['blockId', 'block', 'catId']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
    public function add(Request $request): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Добавление ссылки');
        $view->setMeta('Добавление ссылки', 'links add');

        $link = new CreateLinkForm();

        if ($request->isPost()) {
            $link->loadData($request->getRequestBody());
            if ($link->validate() && $link->save()) {
                App::$app->session->setPopup('success', 'Ссылка успешно добавлена');
                App::$app->response->redirect("/admin/links/{$this->route['cid']}/admin-index");

                exit();
            }
        }

        $blocks = Blocks::blockList($this->route['cid']);

        $data = [
            'model' => $link,
            'blocks' => array_column($blocks, 'name', 'id'),
            'selected' => $this->route['id'],
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function update(Request $request): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Редактирование ссылки');
        $view->setMeta('Редактирование ссылки', 'links update');

        $link = UpdateLinkForm::findOne(['id' => $this->route['id']]);

        $blocks =  Blocks::blockList(Blocks::getCatId($link->blockid));

        if ($request->isPost()) {
            $link->loadData($request->getRequestBody());

            if ($link->validate() && $link->update(['id' => $link->id])) {
                App::$app->session->setPopup('success', 'Ссылка успешно обновлена');
                App::$app->response->redirect("/admin/links/" . Blocks::getCatId($link->blockid) . "/admin-index");

                exit();
            }
        }

        $data = [
            'model' => $link,
            'blocks' => array_column($blocks, 'name', 'id'),
            'selected' => $link->blockid,
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function delete(): void
    {
        $link = ModelsLinks::findOne(['id' => $this->route['id']]);

        if ($link->delete(['id' => $this->route['id']])) {
            App::$app->session->setPopup('success', 'Ссылка успешно удалена');
        } else {
            App::$app->session->setPopup('warning', 'Произошла ошибка при удалении ссылки');
        }

        App::$app->response->redirect('/admin/links/' . Blocks::getCatId($link->blockid) . '/admin-index');

        exit();
    }
}
