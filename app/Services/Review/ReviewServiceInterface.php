<?php

namespace App\Services\Review;
use App\DTO\Review\StoreReviewDTO;
use App\DTO\Review\UpdateReviewDTO;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

interface ReviewServiceInterface
{
    public function getAllReviews(): Collection;

    public function create(StoreReviewDTO $storeReviewDTO): Review;

    public function getReview(Review $review): Review;

    public function update(UpdateReviewDTO $updateReviewDTO, Review $review): Review;

    public function delete(Review $review): void;

    public function getIdEntity(string $reviewable_type, string $reviewable_id): Collection;
}
