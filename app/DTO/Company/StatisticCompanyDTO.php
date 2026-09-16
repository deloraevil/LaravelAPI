<?php

namespace App\DTO\Company;

use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

readonly class StatisticCompanyDTO
{
    public function __construct(public ?float $avgRating, public int $totalReviews, public array $ratingDistribution,
                                public ?CarbonInterface $latestReviewDate, public ?float $avgContentLength)
    {

    }
}
