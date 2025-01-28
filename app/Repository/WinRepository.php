<?php

namespace App\Repository;

use App\Models\LuckyHistory;
use Illuminate\Database\Eloquent\Collection;

class WinRepository
{
    public function create(array $data): LuckyHistory
    {
        return LuckyHistory::query()->create($data);
    }

    public function getHistory(int $userId): Collection
    {
        return LuckyHistory::query()
            ->where('user_id', $userId)
            ->latest()
            ->limit(3)
            ->get();
    }
}
