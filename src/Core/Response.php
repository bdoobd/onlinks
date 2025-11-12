<?php

namespace App\Core;

class Response
{
    private string $content;
    private int $statusCode;
    private array $headers;

    public function __construct(string $content = '', int $statusCode = 200, array $headers = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }
    /**
     * Устанавливает значение в аттрибут $content содержимого ответа
     * 
     * @param string $content Значение для утановки содержимого
     * @return void
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    /**
     * Устанавливает значение кода ответа для клиента
     * 
     * @param int $code Код статуса ответа
     * @return void
     */
    public function setStatusCode(int $code): void
    {
        $this->statusCode = $code;
    }
    /**
     * Устанавливает залоговок для HTML header и его значение
     * 
     * @param string $name Имя заголовка header
     * @param string $value Значения для заголовка header
     * @return void
     */
    public function header(string $name, string $value): void
    {
        $this->headers[$name] = $value;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        echo $this->content;
    }
    /**
     * Возвращает содержимое HTML разметки в виде строки
     * 
     * @return string Строка HTML разметки
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
