<?php

use App\Http\Controllers\Api\BlogController;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/


Route::group(['prefix' => 'v1'], function () {

    Route::get('posts', [BlogController::class, 'index']);
    Route::get('posts/search', [BlogController::class, 'search']);
    Route::get('posts/{id}', [BlogController::class, 'show']);

    Route::get('tags', [BlogController::class, 'getTags']);
});
