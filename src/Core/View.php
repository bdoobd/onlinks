<?php

namespace App\Core;

class View
{
    public string $layout = 'main';
    public array $route = [];

    public function __construct(array $route)
    {
        $this->route = $route;
    }
    public function render($data = []): string
    {
        $viewFile = $this->route;

        $layoutFile = App::$ROOTPATH . '/src/Views/layouts/' . $this->layout . '.php';
        $content = $this->renderContent($data);


        ob_start();
        include_once $layoutFile;
        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $content, $layoutContent);
    }

    public function renderContent(array $data = [])
    {
        $viewFile = App::$ROOTPATH . '/src/Views/' . ucfirst($this->route['controller']) . '/' . $this->route['action'] . '.php';
        ob_start();
        extract($data);
        include_once $viewFile;
        return ob_get_clean();
    }
}
