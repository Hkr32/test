<?php

namespace App\Exceptions;

use RuntimeException;

class NotFoundViewException extends RuntimeException
{
    public function __construct(string $path)
    {
        parent::__construct(sprintf('View "%s" not found.', $path));
    }
}
