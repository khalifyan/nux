<?php

namespace App\Action\Win;

use App\DTO\Win\WinRequestData;
use App\Repository\WinRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

readonly class LuckyHistoryAction
{
    public function __construct(
        private WinRepository $winRepository,
    )
    {
    }

    public function execute(WinRequestData $data): Collection
    {
        $cacheKey = "history_user_{$data->userId}";

        return Cache::remember($cacheKey, 3600, function () use ($data) {
            return $this->winRepository->getHistory($data->userId);
        });
    }
}
