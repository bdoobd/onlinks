<?php

namespace App\Controllers;

class Error
{
    static public function missing(): void
    {
        echo '<pre>';
        var_dump('resource not found, please proceed to index');
        echo '</pre>';
    }
}
