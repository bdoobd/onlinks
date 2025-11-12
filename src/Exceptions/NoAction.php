<?php

namespace App\Exceptions;

class NoAction extends \Exception
{
    public function __construct(
        $message = 'Action not found'
    ) {
        parent::__construct($message, 404);
    }
}
