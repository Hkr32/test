<?php

namespace App\Queries;

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
}
