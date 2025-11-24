<?php

namespace App\Core;

use App\Controllers\Error as ControllersError;
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
    /**
     * Обработка исключений
     * 
     * @param Throwable $e Объект возникшего исключения
     * 
     * @return 
     */
    public function handle(Throwable $e)
    {
        $this->logError($e);

        if (App::$app->isDev) {
            return $this->devResponse($e);
        }

        return $this->prodResponse($e);
    }
    /**
     * Лонирование ошибки в файл
     * 
     * @param Throwable $e Объект возникшего исключения
     * 
     * @return void
     */
    public function logError(Throwable $e): void
    {
        $msg = sprintf(
            "[%s] %d %s in %s: line %d\n%s\n\n",
            date('d-m-Y H:i:s'),
            $e->getCode(),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getTraceAsString()
        );

        file_put_contents($this->logFile, $msg, FILE_APPEND);
    }
    /**
     * Обработка исключения с отображением ошибки с стека в браузер
     * 
     * @param Throwable $e Объект возникшего исключения
     * 
     * @return
     */
    public function devResponse(Throwable $e)
    {
        $data = [
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile(),
            'trace' => $e->getTraceAsString(),
            'code' => $e->getCode(),
        ];

        $controller = new ControllersError([
            "controller" => "error",
            "action" => "devError",
        ]);

        return $controller->renderDevError($data);
    }
    /**
     * Обработка исключения с переадресацией на общую страницу ошибки в режиме продакшн
     * 
     * @param Throwable $e Объект возникшего исключения
     * 
     * @return Response Объект ответа с информацией об ошибке
     */
    public function prodResponse(Throwable $e): Response
    {
        return new Response('Произошла ошибка. Пожалуйста, попробуйте позже.', $e->getCode());
    }
}
