<?php
namespace App\DTO\UniqueLink;

class UniqueLinkGenerateRequestData
{
    public function __construct(
        public int $userId,
    ) { }
}
