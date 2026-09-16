<?php

namespace App\Services\Company;

use App\DTO\Company\StatisticCompanyDTO;
use App\DTO\Company\StoreCompanyDTO;
use App\DTO\Company\TopCompanyDTO;
use App\DTO\Company\UpdateCompanyDTO;
use App\Models\Company;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection as SupportCollection;


class CompanyService implements CompanyServiceInterface
{
    public function __construct()
    {
    }

    public function getAllCompanies(): EloquentCollection
    {
        return Company::all();
    }

    public function create(StoreCompanyDTO $storeCompanyDTO): Company
    {
        return Company::query()->create($storeCompanyDTO->toArray());
    }

    public function getCompany(Company $company): Company
    {
        return $company;
    }

    public function update(UpdateCompanyDTO $updateCompanyDTO, Company $company): Company
    {
        $company->update($updateCompanyDTO->toArray());
        return $company->refresh();
    }

    public function delete(Company $company): void
    {
        $company->delete();
    }


    public function getCompanyStatistics(Company $company) :StatisticCompanyDTO
    {
        $review_data = $company->reviews()->get(['rating', 'content', 'created_at']);

        $ratingDistribution = [];

        for ($rating = 1; $rating <= 10; $rating++) {
            $ratingDistribution[(string) $rating] = 0;
        }

        foreach ($review_data as $review) {
            $ratingDistribution[(string) $review->rating]++;
        }

        if ($review_data->isEmpty()) {
            return new StatisticCompanyDTO(
                avgRating: null,
                totalReviews: 0,
                ratingDistribution: $ratingDistribution,
                latestReviewDate: null,
                avgContentLength: null,
            );
        }

        $latestReview = $review_data->sortByDesc('created_at')->first();

        return new StatisticCompanyDTO(
            avgRating: round((float) $review_data->avg('rating'), 1),
            totalReviews: $review_data->count(),
            ratingDistribution: $ratingDistribution,
            latestReviewDate: $latestReview->created_at,
            avgContentLength: round((float) $review_data->avg(fn (Review $review): int => mb_strlen($review->content)), 1),
        );

    }

    public function getTopCompany(): SupportCollection
    {
        return Company::query()
            ->withAvg('reviews', 'rating') //reviews_avg_rating
            ->withCount('reviews') //reviews_count
            ->get()
            ->sort(function (Company $firstCompany, Company $secondCompany): int {
                $firstRating = $firstCompany->reviews_avg_rating;
                $secondRating = $secondCompany->reviews_avg_rating;

                if ($firstRating === null && $secondRating !== null) {
                    return 1;
                }

                if ($firstRating !== null && $secondRating === null) {
                    return -1;
                }

                if ($firstRating !== null && $secondRating !== null && $firstRating !== $secondRating) {
                    //return $secondRating <=> $firstRating; //desc
                    if ($firstRating > $secondRating) {
                        return -1;
                    }
                    elseif ($firstRating < $secondRating) {
                        return 1;
                    }
                    else{
                        return 0;
                    }
                }

                return $secondCompany->reviews_count <=> $firstCompany->reviews_count;
            })
            ->take(10)
            //->values()
            ->map(fn (Company $company): TopCompanyDTO => new TopCompanyDTO(
                id: $company->id,
                title: $company->name,
                avgRating: $company->reviews_avg_rating === null
                    ? null
                    : round((float) $company->reviews_avg_rating, 1),
                reviewsCount: $company->reviews_count,
            ));
    }
}
