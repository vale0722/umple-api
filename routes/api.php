<?php

use App\Http\Controllers\Api\FollowerController;
use App\Http\Controllers\Api\InteractionController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->prefix('auth')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});
