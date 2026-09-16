<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function (): void {
    include __DIR__ . '/User/api.php';
    include __DIR__ . '/Company/api.php';
    include __DIR__ . '/Review/api.php';
});


Route::get('/health', function (){
    return response()->json([
        'ok'=>true
    ]);
});

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (){
    return 'testkekw';
});


Route::get('/health', [\App\Http\Controllers\FirstController::class, 'give_answer']);

//posts
Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show')->where('post', '[0-9]+');
Route::match(['put', 'patch'], '/posts/{post}', [\App\Http\Controllers\PostController::class, 'update'])->name('posts.update')->where('post', '[0-9]+');
Route::delete('/posts/{post}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('posts.destroy')->where('post', '[0-9]+');*/
