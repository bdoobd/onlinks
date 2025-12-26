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
    public function index(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Category index');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');

        $blocks = Blocks::runPrepQuery($this->createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'info' => 'HOME section',
            'data' => $this->formatData($blocks),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }

    public function blogs(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Blogs section');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');

        $blocks = Blocks::runPrepQuery($this->createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'info' => 'Blogs section',
            'data' => $this->formatData($blocks),
        ];


        $markup = $view->render($data);

        return new Response($markup);
    }

    public function tech(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Tech section');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');

        $blocks = Blocks::runPrepQuery($this->createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'info' => 'Tech section',
            'data' => $this->formatData($blocks),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
    public function sport(): Response
    {
        $view = new View($this->route);
        $view->setTitle('Tech section');
        $view->setMeta('Working on PHP app project', 'Framework, PHP, WebAPP');


        $blocks = Blocks::runPrepQuery($this->createSQLString(), ['id' => $this->route['id']]);

        $data = [
            'info' => 'Sport section',
            'data' => $this->formatData($blocks),
        ];

        $markup = $view->render($data);

        return new Response($markup);
    }
    /**
     * Получить строку для выборки блоков с фильтром по категориям
     * 
     * @return string
     */
    private function createSQLString(): string
    {
        return "SELECT b.id as blockId, b.name as block, l.id as linkId, l.name as item, l.link FROM blocks as b  
                JOIN links as l ON 
                b.id = l.blockid WHERE b.catid = :id";
    }
    /**
     * Отформатировать массив полученых из базы данных для передачи в шаблон
     * 
     * @param array $fetched Массив полученный после запроса к базе данных
     * 
     * @return array
     */
    private function formatData(array $fetched): array
    {
        $tmpArray = [];
        foreach ($fetched as $block) {
            $blockId = $block->blockId;

            if (!isset($tmpArray[$blockId])) {
                $tmpArray[$blockId] = [
                    'blockId' => $blockId,
                    'name' => $block->block,
                    'links' => [],
                ];
            }

            $tmpArray[$blockId]['links'][] = [
                'linkId' => $block->linkId,
                'name' => $block->item,
                'url' => $block->link,
            ];
        }

        return array_values($tmpArray);
    }
}
