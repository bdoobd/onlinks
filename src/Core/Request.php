<?php

namespace App\Core;

class Request
{
    /**
     * Возвращает название метода из глобальной переменной $_SERVER['REQUEST_METHOD']
     * 
     * @return string Строковое название метода
     */
    private function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    /**
     * Проверяет является ли запрос методом GET
     * 
     * @return bool 
     */
    public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }
    /**
     * Проверяет является ли запрос методом POST
     * 
     * @return bool 
     */
    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    public function getRequestBody(): array
    {
        $data = [];

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        return $data;
    }
}
