<?php

namespace App\Core;

use Throwable;

class Error
{
    private string $viewPath;
    private string $logFile;

    public function __construct()
    {
        $this->viewPath = '/errors/';
        $this->logFile = App::$ROOTPATH . '/logs/' . ($_ENV['LOG_FILE'] ?? 'error.log');
    }

    public function handle(Throwable $e): Response
    {
        // TODO: Логировать ошибку
        $this->logError($e);

        // TODO: Если режим разработки, показать подробную информацию об ошибке
        if (App::$app->isDev) {
            return $this->devResponse($e);
        }

        // TODO: Иначе показать общую страницу ошибки
        return $this->prodResponse($e);
    }

    public function logError(Throwable $e): void
    {
        // TODO: Error logger
        $msg = '[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine() . PHP_EOL;
        file_put_contents($this->logFile, $msg, FILE_APPEND);
    }

    public function devResponse(Throwable $e): Response
    {
        return new Response('Dev ошибка', $e->getCode());
    }

    public function prodResponse(Throwable $e): Response
    {
        return new Response('Произошла ошибка. Пожалуйста, попробуйте позже.', $e->getCode());
    }
}
