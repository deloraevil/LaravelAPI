<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/reviews/entity/{reviewable_type}/{reviewable_id}', [\App\Http\Controllers\ReviewController::class, 'Entity'])->name('reviews.Entity');
//crud
Route::get('/reviews', [\App\Http\Controllers\ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'show'])->name('reviews.show');
Route::match(['put', 'patch'], '/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'update'])->name('reviews.update');
Route::delete('reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');
