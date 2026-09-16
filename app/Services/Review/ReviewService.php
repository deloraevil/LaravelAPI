<?php

namespace App\Services\Review;

use App\DTO\Review\StoreReviewDTO;
use App\DTO\Review\UpdateReviewDTO;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

class ReviewService implements ReviewServiceInterface
{
    public function __construct()
    {
    }

    public function getAllReviews(): Collection
    {
        return Review::query()->with(['author', 'reviewable'])->get();
    }

    public function create(StoreReviewDTO $storeReviewDTO): Review
    {
        return Review::query()->create($storeReviewDTO->toArray())->load(['author', 'reviewable']);
    }

    public function getReview(Review $review): Review
    {
        return $review->load(['author', 'reviewable']);
    }

    public function update(UpdateReviewDTO $updateReviewDTO, Review $review): Review
    {
        $review->update($updateReviewDTO->toArray());

        return $review->refresh()->load(['author', 'reviewable']);
    }

    public function delete(Review $review): void
    {
        $review->delete();
    }

    public function getIdEntity(string $reviewable_type, string $reviewable_id): Collection{
        return Review::query()
            ->with(['author', 'reviewable'])
            ->where('reviewable_type', $reviewable_type)
            ->where('reviewable_id', $reviewable_id)
            ->get();
    }
}
