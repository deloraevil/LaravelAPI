<?php

/*
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (){
    return 'testkekw';
});


Route::get('/health', [\App\Http\Controllers\FirstController::class, 'give_answer']);

//posts
Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [\App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show')->where('post', '[0-9]+');


Route::get('/posts/update', [\App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
Route::get('/posts/delete', [\App\Http\Controllers\PostController::class, 'delete'])->name('posts.delete');

*/

Route::get('/health', function (){
    return response()->json([
        'ok'=>true
    ]);
});
