<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('api.posts.')
    ->prefix('posts')
    ->group(function () {
        Route::resource('', PostController::class)->except('show');
    });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
