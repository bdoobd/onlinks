<?php

namespace App\Controllers;

use App\Core\App;
use App\Core\BaseController;
use App\Core\Model;
use App\Core\Response;
use App\Core\View;
use App\Models\Blocks;
use App\Models\Categories as ModelsCategories;
use PDO;

class Categories extends BaseController
{
    // public function read(): Response
    // {
    //     $view = new View($this->route);
    //     $view->setTitle('Category section');
    //     // $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');


    //     $model = ModelsCategories::findAll();

    //     $data = array(
    //         'route' => $this->route,
    //         'title' => 'Category section',
    //         'header' => 'Categories Read Header',
    //         'model' => $model,
    //     );

    //     $markup = $view->render($data);

    //     return new Response($markup);
    // }

    public function index(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Category index');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');

        $blocks = Blocks::findMany(['catid' => $this->route['id']]);

        $data = [
            'info' => 'HOME section',
            'blocks' => $blocks,
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function blogs(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Blogs section');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');

        $blocks = Blocks::findMany(['catid' => $this->route['id']]);

        $data = [
            'info' => 'Blogs section',
            'blocks' => $blocks,
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function tech(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Tech section');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');

        $blocks = Blocks::findMany(['catid' => $this->route['id']]);

        $data = [
            'info' => 'Tech section',
            'blocks' => $blocks,
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
    public function sport(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Tech section');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');

        $blocks = Blocks::findMany(['catid' => $this->route['id']]);

        $data = [
            'info' => 'Sport section',
            'blocks' => $blocks,
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
}
