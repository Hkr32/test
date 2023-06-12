<?php

namespace App\Exceptions;

use RuntimeException;

class NotFoundHttpException extends RuntimeException
{
    public function __construct(string $message)
    {
        parent::__construct($message, 404);
    }
}
