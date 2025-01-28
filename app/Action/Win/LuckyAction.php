<?php

namespace App\Action\Win;

use App\DTO\Win\WinRequestData;
use App\Models\LuckyHistory;
use App\Repository\WinRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

readonly class LuckyAction
{
    public function __construct(
        private WinRepository $winRepository,
    ) { }

    public function execute(WinRequestData $data): LuckyHistory
    {
        $randomNumber = rand(1, 1000);
        $result = $randomNumber % 2 === 0 ? 'Win' : 'Lose';
        $winAmount = 0;

        if ($result === 'Win') {
            if ($randomNumber > 900) $winAmount = $randomNumber * 0.7;
            elseif ($randomNumber > 600) $winAmount = $randomNumber * 0.5;
            elseif ($randomNumber > 300) $winAmount = $randomNumber * 0.3;
            else $winAmount = $randomNumber * 0.1;
        }

        return DB::transaction(function () use ($result, $winAmount, $randomNumber, $data) {
            $history = $this->winRepository->create([
                'user_id' => $data->userId,
                'random_number' => $randomNumber,
                'result' => $result,
                'win_amount' => $winAmount,
            ]);

            $this->setToCache($data, $history);

            return $history;
        });
    }

    private function setToCache(WinRequestData $data, LuckyHistory $history): void
    {
        $cacheKey = "history_user_{$data->userId}";
        $historyList = Cache::get($cacheKey, collect());
        $historyList->prepend($history)->splice(3);;
        Cache::put($cacheKey, $historyList, 3600);
    }
}
