<?php

namespace App\Action\UniqueLink;

use App\Repository\UniqueLinkRepository;

readonly class DeactivateLinkAction
{
    public function __construct(
        private UniqueLinkRepository $uniqueLinkRepository
    ) { }

    public function execute(string $link): void
    {
        $this->uniqueLinkRepository->updateByLink($link, [
            'expires_at' => now(),
            'is_active' => false,
        ]);
    }
}
