<?php

namespace App\Services;

use App\Queries\PromoCodeQuery;

final readonly class User
{
    private PromoCodeQuery $query;

    public function __construct()
    {
        $this->query = new PromoCodeQuery;
    }

    public function register(): int
    {
        $lastId = $this->query->getLastUserId();

        return $lastId ? $lastId + 1 : 1;
    }
}
