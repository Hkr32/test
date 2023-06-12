<?php

namespace App\Exceptions;

use RuntimeException;

class NotInitializedAppException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('App not initialized.');
    }
}
