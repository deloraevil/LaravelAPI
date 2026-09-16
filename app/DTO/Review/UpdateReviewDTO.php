<?php

namespace App\DTO\Review;

readonly class UpdateReviewDTO
{
    public function __construct(public array $data){ }

    public function toArray(): array
    {
        return $this->data;
    }
}
