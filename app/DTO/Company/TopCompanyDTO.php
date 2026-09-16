<?php

namespace App\DTO\Company;

readonly class TopCompanyDTO
{
    public function __construct(
        public string $id,
        public string $title,
        public ?float $avgRating,
        public int $reviewsCount,
    ) {}
}
