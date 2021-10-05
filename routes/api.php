<?php

use App\Http\Controllers\Api\FollowerController;
use App\Http\Controllers\Api\InteractionController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Auth\ApiAuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'cors', 'json.response'])->group(function () {
    Route::get('/me', [ApiAuthController::class, 'me'])->name('auth.me');
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');

    Route::name('api.posts.')
        ->group(function () {
            Route::resource('posts', PostController::class)->except('show');
            Route::patch('posts/{post}/interactions', [InteractionController::class, 'interaction'])->name('interaction');
            Route::patch('posts/{post}/comments', [InteractionController::class, 'comment'])->name('comment');
        });

    Route::name('api.users.')
        ->group(function () {
            Route::get('users/followed', [FollowerController::class, 'indexFollowed'])->name('followed');
            Route::get('users/not-followed', [FollowerController::class, 'indexNotFollowed'])->name('not-followed');
            Route::get('users/followers', [FollowerController::class, 'indexFollowers'])->name('followers');
            Route::patch('users/followed/{user}', [FollowerController::class, 'store'])->name('followed.store');
        });
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register', [ApiAuthController::class, 'register'])->name('register.api');
});
