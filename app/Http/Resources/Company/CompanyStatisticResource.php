<?php

namespace App\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyStatisticResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'avgRating' => $this->avgRating,
            'totalReviews' => $this->totalReviews,
            'ratingDistribution' => (object)$this->ratingDistribution,
            'latestReviewDate' => $this->latestReviewDate?->copy()->utc()->format('Y-m-d\TH:i:s\Z'),
            'avgContentLength' => $this->avgContentLength,
        ];
    }
}
