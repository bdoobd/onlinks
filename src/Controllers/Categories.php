<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Response;
use App\Models\Blocks;
use App\Helpers\Helper;
use App\Core\BaseController;

class Categories extends BaseController
{
    public function index(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Category index');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');

        $blocks = Blocks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'data' => Helper::formatDBData($blocks, 'blockId', 'links', ['blockId', 'block']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function blogs(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Blogs section');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');

        $blocks = Blocks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'data' => Helper::formatDBData($blocks, 'blockId', 'links', ['blockId', 'block']),
        ];


        $markup = $view->render($data);

        return new Response($markup);
    }

    public function tech(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Tech section');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');

        $blocks = Blocks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'info' => 'Tech section',
            'data' => Helper::formatDBData($blocks, 'blockId', 'links', ['blockId', 'block']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
    public function sport(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Tech section');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');


        $blocks = Blocks::runPrepQuery(Helper::createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'info' => 'Sport section',
            'data' => Helper::formatDBData($blocks, 'blockId', 'links', ['blockId', 'block']),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
}
