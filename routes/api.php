<?php

use App\Http\Controllers\Api\InteractionController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.posts.')
    ->group(function () {
        Route::resource('posts', PostController::class)->except('show');
        Route::patch('posts/{post}/interactions', [InteractionController::class, 'interaction'])->name('interaction');
        Route::patch('posts/{post}/comments', [InteractionController::class, 'comment'])->name('comment');
    });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
