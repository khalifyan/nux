<?php

namespace App\Action\UniqueLink;

use App\Models\UniqueLink;
use App\Repository\UniqueLinkRepository;

readonly class UniqueLinkViewAction
{
    public function __construct(
        private UniqueLinkRepository $uniqueLinkRepository,
    ) { }

    public function execute(string $link): UniqueLink
    {
        return $this->uniqueLinkRepository->getByLink($link);
    }
}
