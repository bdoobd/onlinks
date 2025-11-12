<?php

namespace App\Core;

use App\Exceptions\{NoAction, NoClass, NotFoundException};
use App\Core\Response;

class Router
{
    private array $routes = [];
    private array $params = [];

    /**
     * Добавляет шаблоны маршрутов в таблицу маршрутизации
     * регулярное выражения для последующего сравниея с URI
     *
     * @param string $url Добавляемый маршрут
     * @param array $params Параметры маршрутов такие как контроллер, метод или namespaice
     * 
     * @return void
     */
    public function add(string $url, array $params = []): void
    {
        $url = preg_replace('/\//', '\\/', $url);
        $url = preg_replace('/\{([a-z-]+)\}/', '(?P<\1>[a-z-]+)', $url);
        $url = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $url);
        $url = '/^' . $url . '$/';

        $this->routes[$url] = $params;
    }

    public function dispatch(string $url): Response
    {
        // TODO: Удалить параметры строки запроста (знаки после ?)

        if ($this->match($url)) {
            $controllerName = 'App\\Controllers\\' . ucfirst($this->params['controller']);;
            $action = $this->params['action'];

            if (!class_exists($controllerName)) {
                throw new NoClass();
            }

            $controller = new $controllerName($this->params);

            if (!method_exists($controller, $action)) {
                throw new NoAction();
            }

            $result = call_user_func([$controller, $action], $this->params);

            if ($result instanceof Response) {
                return $result;
            }

            return new Response((string) $result);
        }

        throw new NotFoundException();
    }

    /**
     * Возвращает массив маршрутов
     *
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
    /**
     * Возвращает массив найденых маршрутов
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    // Protected
    protected function match(string $url): bool
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }

                $this->params = $params;
                return True;
            }
        }

        return False;
    }
    // Private
}
