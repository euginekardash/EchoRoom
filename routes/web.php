<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Post\CreateController;
use App\Http\Controllers\Post\DestroyController;
use App\Http\Controllers\Post\EditController;
use App\Http\Controllers\Post\IndexController;
use App\Http\Controllers\Post\ShowController;
use App\Http\Controllers\Post\StoreController;
use App\Http\Controllers\Post\UpdateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Post\PostLikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('main.index');


    Route::get('/posts', IndexController::class)->name('post.index');
    Route::get('/posts/create', CreateController::class)->name('post.create');
    Route::post('/posts', StoreController::class)->name('post.store');
    Route::get('/posts/{post}', ShowController::class)->name('post.show');
    Route::get('/posts/{post}/edit', EditController::class)->name('post.edit');
    Route::patch('/posts/{post}', UpdateController::class)->name('post.update');
    Route::delete('/posts/{post}', DestroyController::class)->name('post.delete');
    Route::post('/posts/{post}/like', [PostLikeController::class, 'toggle'])
        ->name('post.like');
    Route::get('/posts/{post}/like-status', [\App\Http\Controllers\Post\PostLikeController::class, 'status'])
        ->name('post.like.status');
    Route::get('/likes/statuses', [PostLikeController::class, 'statuses'])->name('likes.statuses');


    Route::get('/posts/update', [PostController::class, 'update']);
    Route::get('/posts/delete', [PostController::class, 'delete']);
    Route::get('/posts/first_or_create', [PostController::class, 'firstOrCreate']);
    Route::get('/posts/update_or_create', [PostController::class, 'updateOrCreate']);

    Route::get('/main', [MainController::class, 'index']);
    Route::get('/contacts', [ContactsController::class, 'index'])->name('contact.index');
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
