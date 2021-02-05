<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authors'], function () {
    Route::get('/', [\App\Http\Controllers\API\AuthorsController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\API\AuthorsController::class, 'show']);
});

Route::group(['prefix' => 'books'], function () {
    Route::get('/', [\App\Http\Controllers\API\BooksController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\API\BooksController::class, 'show']);
});

Route::group(['prefix' => 'genres'], function () {
    Route::get('/', [\App\Http\Controllers\API\GenresController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\API\GenresController::class, 'show']);
});

Route::group(['prefix' => 'sections'], function () {
    Route::get('/', [\App\Http\Controllers\API\SectionsController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\API\SectionsController::class, 'show']);
});

Route::group(['prefix' => 'translators'], function () {
    Route::get('/', [\App\Http\Controllers\API\TranslatorsController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\API\TranslatorsController::class, 'show']);
});
