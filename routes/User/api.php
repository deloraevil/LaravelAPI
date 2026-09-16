<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




//user
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::match(['put', 'patch'], '/users/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
