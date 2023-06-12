<?php

namespace App\Services;

use App\Exceptions\AppException;
use App\Queries\PromoCodeQuery;

final readonly class PromoCode
{
    private PromoCodeQuery $query;

    public function __construct()
    {
        $this->query = new PromoCodeQuery;
    }

    public function getCodeForUser(int $userId): string
    {
        $code = $this->query->getCodeByUser($userId);

        if (!$code) {
            if (!$this->query->takeCodeForUser($userId)) {
                throw new AppException('No promo codes available');
            }

            $code = $this->query->getCodeByUser($userId);
        }

        return $code;
    }
}
