<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;



Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::post('/post', [UserController::class, 'poststore'])->name('post.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show')->where('id', '[0-9]+');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::fallback(function() {
    return response()->view('fallback', [], 404);
});
Route::resource('users', UserController::class);

Route::resource('posts', PostController::class);

Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
