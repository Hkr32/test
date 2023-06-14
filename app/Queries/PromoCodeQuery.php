<?php

namespace App\Queries;

use App\Exceptions\AppException;

final class PromoCodeQuery extends BaseQuery
{
    public function getCodeByUser(int $userId): ?string
    {
        $query = 'SELECT `code` FROM `promocodes` WHERE `user_id` = ? LIMIT 1';

        $result = $this->db->query($query, [$userId])->fetch();

        return $result['code'] ?? null;
    }

    public function takeCodeForUser(int $userId): bool
    {
        if ($this->hasUser($userId)) {
            throw new AppException('The user already has a promo code.');
        }

        $query = 'UPDATE `promocodes` SET `user_id` = ?, `busy_at` = ? WHERE `user_id` IS NULL LIMIT 1';

        $now = date('Y-m-d H:i:s');

        $result = $this->db->query($query, [$userId, $now])->rowCount();

        return (bool) $result;
    }

    public function getLastUserId(): ?int
    {
        $query = 'SELECT `user_id` FROM `promocodes` WHERE `user_id` IS NOT NULL ORDER BY `user_id` DESC LIMIT 1';

        $result = $this->db->query($query)->fetch();

        return $result['user_id'] ?? null;
    }

    public function hasUser(int $userId): bool
    {
        $query = 'SELECT EXISTS(SELECT * FROM `promocodes` WHERE `user_id` = ?) as `has`';

        $result = $this->db->query($query, [$userId])->fetch();

        return (bool) $result['has'];
    }
}
