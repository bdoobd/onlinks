<?php

namespace App\Exceptions;

class NoPropertyException extends \Exception
{
    public function __construct(
        $message = 'Property of object/class not found'
    ) {
        parent::__construct($message, 404);
    }
}
