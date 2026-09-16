<?php

namespace App\Http\Controllers;

use App\DTO\Review\StoreReviewDTO;
use App\DTO\Review\UpdateReviewDTO;
use App\Exceptions\UserMessageException;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Company;
use App\Models\Review;
use App\Models\User;
use App\Services\Review\ReviewServiceInterface;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly ReviewServiceInterface $reviewService) {

    }

    public function index(): JsonResponse
    {
        return $this->withErrorHandling(function () {
            $reviews = $this->reviewService->getAllReviews();

            return $this->success(ReviewResource::collection($reviews));
        });
    }

    public function store(StoreReviewRequest $request): JsonResponse
    {
        return $this->withErrorHandling(function () use ($request) {
            $review = $this->reviewService->create(
                storeReviewDTO: new StoreReviewDTO(
                    user_id: $request->validated('user_id'),
                    reviewable_type: $this->getReviewableClass($request->validated('reviewable_type')),
                    reviewable_id: $request->validated('reviewable_id'),
                    content: $request->validated('content'),
                    rating: $request->validated('rating'),
                )
            );

            return $this->success(new ReviewResource($review));
        });
    }

    public function show(Review $review): JsonResponse
    {
        return $this->withErrorHandling(function () use ($review) {
            $review = $this->reviewService->getReview(review: $review);

            return $this->success(new ReviewResource($review));
        });
    }

    public function update(UpdateReviewRequest $request, Review $review): JsonResponse
    {
        return $this->withErrorHandling(function () use ($request, $review) {
            $data = $request->validated();

            if (isset($data['reviewable_type'])) {
                $data['reviewable_type'] = $this->getReviewableClass($data['reviewable_type']);
            }

            $review = $this->reviewService->update(
                updateReviewDTO: new UpdateReviewDTO(data: $data),
                review: $review
            );

            return $this->success(new ReviewResource($review));
        });
    }

    public function destroy(Review $review): JsonResponse
    {
        return $this->withErrorHandling(function () use ($review) {
            $this->reviewService->delete(review: $review);

            return $this->success([
                'id' => $review->id,
                'message' => 'Отзыв удалён',
            ]);
        });
    }

    public function getReviewableClass(string $type): string
    {
        if ($type === 'user'){
            return User::class;
        }
        if ($type === 'company'){
            return Company::class;
        }

        throw new UserMessageException('Неверный тип сущности', 422);
    }

    public function Entity(string $reviewable_type, string $reviewable_id): JsonResponse
    {
        return $this->withErrorHandling(function () use ($reviewable_type, $reviewable_id) {
            $reviews = $this->reviewService->getIdEntity(
                reviewable_type: $this->getReviewableClass($reviewable_type),
                reviewable_id: $reviewable_id,
            );

            return $this->success(ReviewResource::collection($reviews));
        });
    }
}
