<?php

namespace App\Controllers\admin;

use App\Core\App;
use App\Core\View;
use App\Core\Request;
use App\Core\Response;
use App\Helpers\Helper;
use App\Models\Categories;
use App\Core\BaseController;
use App\Forms\CreateBlockForm;
use App\Models\Blocks as ModelsBlocks;
use App\Core\Middlewares\AuthMiddleware;

class Blocks extends BaseController
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->addMiddleware(new AuthMiddleware());
    }

    public function adminAll(): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Блоки категорий');
        $view->setMeta('Работа с блоками категорий', 'blogs all');

        $data = ModelsBlocks::runPrepQuery(Helper::createBlocksSQLString());

        $data = [
            'data' => Helper::formatDBData($data, 'catId', 'blocks', ['catId', 'cat']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function add(Request $request): Response
    {
        $view = new View($this->route);
        $view->setLayout('admin');
        $view->setTitle('Добавление блока');
        $view->setMeta('Добавление блока', 'blocks add');

        $block = new CreateBlockForm();
        if ($request->isPost()) {
            $block->loadData($request->getRequestBody());

            if ($block->validate() && $block->save()) {
                App::$app->session->setPopup('success', 'Блок успешно создан');
                App::$app->response->redirect('/admin/blocks/admin-all');

                exit();
            }
        }

        $categoryOptions = [];
        foreach (Categories::catList() as $cat) {
            $categoryOptions[$cat->id] = $cat->name;
        }

        $block->itemnum = $block->getNextItemNumber($this->route['id']);

        $data = [
            'model' => $block,
            'cats' => $categoryOptions,
            'selected' => $this->route['id'],
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
}
