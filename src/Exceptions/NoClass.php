<?php

namespace App\Exceptions;

class NoClass extends \Exception
{
    public function __construct(
        $message = 'Class not found'
    ) {
        parent::__construct($message, 500);
    }
}
