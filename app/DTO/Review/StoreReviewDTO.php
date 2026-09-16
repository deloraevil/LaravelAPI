<?php

namespace App\DTO\Review;

readonly class StoreReviewDTO
{
    public function __construct(
        public string $user_id,
        public string $reviewable_type,
        public string $reviewable_id,
        public string $content,
        public int $rating,
    ) {}

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'reviewable_type' => $this->reviewable_type,
            'reviewable_id' => $this->reviewable_id,
            'content' => $this->content,
            'rating' => $this->rating,
        ];
    }
}
