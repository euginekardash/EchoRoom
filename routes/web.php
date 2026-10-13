<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return 'dsdsdsd';
});

Route::get('/posts', [PostController::class, 'index']);
