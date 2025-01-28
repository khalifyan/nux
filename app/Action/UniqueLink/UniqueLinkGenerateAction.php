<?php

namespace App\Action\UniqueLink;

use App\DTO\UniqueLink\UniqueLinkGenerateRequestData;
use App\Models\UniqueLink;
use App\Repository\UniqueLinkRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

readonly class UniqueLinkGenerateAction
{
    public function __construct(
        private UniqueLinkRepository $uniqueLinkRepository,
        private DeactivateLinksAction $deactivateLinksAction
    ) { }

    public function execute(UniqueLinkGenerateRequestData $data): UniqueLink
    {
        return DB::transaction(function () use ($data) {
            $this->deactivateLinksAction->execute($data);

            return $this->uniqueLinkRepository->create([
                'link' => Str::random(32),
                'expires_at' => now()->addDays(7),
                'user_id' => $data->userId,
                'is_active' => true,
            ]);
        });
    }
}
