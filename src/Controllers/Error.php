<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;

class Error
{
    static public function missing(NotFoundException $error): void
    {
        // http_response_code($error->getCode());

        echo '<pre>';
        var_dump('resource not found, please proceed to index', $error->getCode());
        echo '</pre>';
    }
}
