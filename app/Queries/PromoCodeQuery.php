<?php

namespace App\Queries;

final class PromoCodeQuery extends BaseQuery
{
    public function getCodeByUser(int $userId): string
    {
        $query = 'SELECT `code` FROM `promocodes` WHERE `user_id` = ? LIMIT 1';

        $result = $this->db->query($query, [$userId]);

        return $result->fetch(); //TODO WIP
    }

    public function takeCodeForUser(int $userId): bool
    {
        $query = 'UPDATE `promocodes` SET `user_id` = ?, `busy_at` = ? WHERE `user_id` IS NULL LIMIT 1';
        $now = date('Y-m-d H:i:s');

        $result = $this->db->query($query, [$userId, $now]);

        return $result->fetch(); //TODO WIP
    }
}
