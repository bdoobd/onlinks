<?php

namespace App\Exceptions;

class NotFoundException extends \Exception
{
    public function __construct(
        // $message = 'Resource not found'
        $message
    ) {
        parent::__construct($message, 404);
    }
}
