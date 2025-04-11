<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ModeratorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::get('/create',[PostController::class, 'create'])->name('post.create');
    Route::post('/',[PostController::class, 'store'])->name('post.store');
    Route::get('/{post}', [PostController::class, 'show'])->name('post.show');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/{post}/edit', [PostController::class, 'update'])->name('post.update');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('post.delete');  
});

Route::middleware('auth')->prefix('moderator')->group(function () {
    Route::get('/', [ModeratorController::class, 'index'])->name('moderator.index');
    Route::get('/{post}/edit', [ModeratorController::class, 'edit'])->name('moderator.edit');
    Route::patch('/{post}/edit', [ModeratorController::class, 'update'])->name('moderator.update');
});

Route::middleware([\App\Http\Middleware\Admin::class])->prefix('moderator')->group(function () {
Route::get('/{post}', [ModeratorController::class, 'show'])->name('moderator.show');
Route::post('/{post}/accept', [ModeratorController::class, 'accept'])->name('moderator.accept');
Route::post('/{post}/reject', [ModeratorController::class, 'reject'])->name('moderator.reject');
});

require __DIR__.'/auth.php';
