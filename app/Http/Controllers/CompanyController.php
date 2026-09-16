<?php

namespace App\Http\Controllers;

use App\DTO\Company\StoreCompanyDTO;
use App\DTO\Company\UpdateCompanyDTO;
use App\Http\Requests\Company\StatisticCompanyRequest;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Resources\Company\CompanyResource;
use App\Http\Resources\Company\CompanyStatisticResource;
use App\Http\Resources\Company\CompanyTopResource;
use App\Models\Company;
use App\Services\Company\CompanyServiceInterface;
use App\Services\User\UserServiceInterface;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use HttpResponse;

    public function __construct(private readonly CompanyServiceInterface $companyService) {

    }

    public function index(): JsonResponse
    {
        return $this->withErrorHandling(function (){
            $companies = $this->companyService->getAllCompanies();

            return $this->success(CompanyResource::collection($companies));
        });
    }

    public function store(StoreCompanyRequest $request): JsonResponse
    {
        return $this->withErrorHandling(function () use ($request) {
            $img_path = null;

            if ($request->hasFile('img_path')) {
                $img_path = $request->file('img_path')->store('companies', 'public');
            }

            $company = $this->companyService->create(
                storeCompanyDTO: new StoreCompanyDTO(
                    name: $request->validated('name'),
                    description: $request->validated('description'),
                    img_path: $img_path,
                )
            );

            return $this->success(new CompanyResource($company));
        });
    }

    public function show(Company $company): JsonResponse
    {
        return $this->withErrorHandling(function () use ($company) {
            $company = $this->companyService->getCompany(company: $company);

            return $this->success(new CompanyResource($company));
        });
    }

    public function update(UpdateCompanyRequest $request, Company $company): JsonResponse
    {
        return $this->withErrorHandling(function () use ($request, $company) {
            $data = $request->validated();

            if ($request->hasFile('img_path')) {
                $data['img_path'] = $request->file('img_path')->store('companies', 'public');
            } elseif ($request->has('img_path') && blank($request->input('img_path'))) {
                $data['img_path'] = null;
            } else {
                unset($data['img_path']);
            }

            $company = $this->companyService->update(
                updateCompanyDTO: new UpdateCompanyDTO(data: $data),
                company: $company
            );

            return $this->success(new CompanyResource($company));
        });
    }

    public function destroy(Company $company): JsonResponse
    {
        return $this->withErrorHandling(function () use ($company) {
            $this->companyService->delete(company: $company);

            return $this->success([
                'id' => $company->id,
                'message' => 'Компания удалена',
            ]);
        });
    }
    public function getStatistics(Company $company): JsonResponse
    {
        return $this->withErrorHandling(function () use ($company) {
            $statistics = $this->companyService->getCompanyStatistics(company: $company);

            return $this->success(new CompanyStatisticResource($statistics));
        });
    }

    public function topCompany(): JsonResponse
    {
        return $this->withErrorHandling(function () {
            $companies = $this->companyService->getTopCompany();

            return $this->success(CompanyTopResource::collection($companies));
        });
    }

}
