<?php

namespace App\Services\Company;


use App\DTO\Company\StatisticCompanyDTO;
use App\DTO\Company\StoreCompanyDTO;
use App\DTO\Company\UpdateCompanyDTO;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection as SupportCollection;

interface CompanyServiceInterface
{
    public function getAllCompanies() :EloquentCollection;

    public function create(StoreCompanyDTO $storeCompanyDTO) :Company;

    public function getCompany(Company $company) :Company;

    public function update(UpdateCompanyDTO $updateCompanyDTO, Company $company) :Company;

    public function delete(Company $company) :void;

    public function getCompanyStatistics(Company $company) :StatisticCompanyDTO;

    public function getTopCompany(): SupportCollection;
}
