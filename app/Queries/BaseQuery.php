<?php

namespace App\Queries;

use App\Application;
use App\Database\Database;

abstract class BaseQuery
{
    protected readonly Database $db;

    public function __construct()
    {
        $this->db = Application::instance()->db;
    }
}
