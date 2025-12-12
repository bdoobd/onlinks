<?php

namespace App\Core;

class View
{
    protected string $layout = 'main';
    protected array $meta = [];
    public array $route;
    protected string $title = 'Default title, please set title';

    public function __construct(array $route = [])
    {
        $this->route = $route;
        $this->meta = array('description' => 'Default project\'s description', 'keywords' => 'Please set keywords for project app');
    }
    /**
     * Сборка шаблона и динамического содержания для отображения
     * 
     * @param array $data Данные для отображения на странице
     * 
     * @return string
     */
    public function render($data = []): string
    {
        $layoutFile = App::$ROOTPATH . '/src/Views/layouts/' . $this->layout . '.php';
        $content = $this->renderContent($data);

        ob_start();
        include_once $layoutFile;
        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $content, $layoutContent);
    }
    /**
     * Формирование содержимого для отображения
     * 
     * @param array $data Массив данных для отображения
     * 
     * @return string
     */
    public function renderContent(array $data = []): string
    {
        $viewFile = App::$ROOTPATH . '/src/Views/' . ucfirst($this->route['controller']) . '/' . $this->route['action'] . '.php';

        ob_start();
        extract($data);

        include_once $viewFile;

        return ob_get_clean();
    }
    /**
     * Устанавливает значене для тега TITLE
     * 
     * @param string $title Значение для тега TITLE 
     * 
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = htmlspecialchars($title);
    }
    /**
     * Устанавливает значения для тегов META DESCRIPTION и META KEYWORDS
     * 
     * @param string $description Значение для тега META DESCRIPTION
     * @param string $keywords Значение для тега META KEYWORDS (значеня разделённые запятыми)
     * 
     * @return void
     */
    public function setMeta(string $description = '', string $keywords = ''): void
    {
        $this->meta = array('description' => $description, 'keywords' => $keywords);
    }

    public function getMeta(): string
    {
        $metadata = <<<DTR
        <meta name='description' content='<?= {$this->meta['description']} ?>'>
        <meta name='keywords' content='<?= {$this->meta['keywords']} ?>'
        DTR;

        return $metadata;
    }
    /**
     * Устанавливает базовый шаблон для отображения 
     * 
     * @param string $layout Название базового шаблона
     * 
     * @return void
     */
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }
}
