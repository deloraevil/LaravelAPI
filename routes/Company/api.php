<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('companies/statistic/{company}', [\App\Http\Controllers\CompanyController::class, 'getStatistics'])->name('companies.statistics');
Route::get('/companies/top', [\App\Http\Controllers\CompanyController::class, 'topCompany'])->name('companies.top');
//crud
Route::get('/companies', [\App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
Route::post('/companies', [\App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
Route::get('/companies/{company}', [\App\Http\Controllers\CompanyController::class, 'show'])->name('companies.show');
Route::match(['put', 'patch'], '/companies/{company}', [\App\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');
Route::delete('companies/{company}', [\App\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');
