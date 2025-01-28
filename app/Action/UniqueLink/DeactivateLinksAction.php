<?php

namespace App\Action\UniqueLink;

use App\DTO\UniqueLink\UniqueLinkGenerateRequestData;
use App\Repository\UniqueLinkRepository;

readonly class DeactivateLinksAction
{
    public function __construct(
        private UniqueLinkRepository $uniqueLinkRepository
    ) { }

    public function execute(UniqueLinkGenerateRequestData $data): void
    {
        $this->uniqueLinkRepository->updateByUserId($data->userId, [
            'expires_at' => now(),
            'is_active' => false,
        ]);
    }
}
