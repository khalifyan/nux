<?php

namespace App\Repository;

use App\Models\UniqueLink;

class UniqueLinkRepository
{

    public function create(array $data): UniqueLink
    {
        return UniqueLink::query()->create($data);
    }

    public function updateByUserId(int $userId, array $values): void
    {
        UniqueLink::query()->where('user_id', $userId)->update($values);
    }

    public function updateByLink(string $link, array $values): void
    {
        UniqueLink::query()->where('link', $link)->update($values);
    }

    public function getByLink(string $link): UniqueLink
    {
        return UniqueLink::query()->where('link', $link)->first();
    }
}
