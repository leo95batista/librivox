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

Route::group(['prefix' => 'info'], function () {
    Route::view('/', 'api.info');
});

Route::group(['prefix' => 'stats'], function () {
    Route::get('/', [\App\Http\Controllers\API\StatsController::class, 'index']);
});

Route::group(['prefix' => 'authors'], function () {
    Route::get('/', [\App\Http\Controllers\API\AuthorsController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\API\AuthorsController::class, 'show']);
});

Route::group(['prefix' => 'books'], function () {
    Route::get('/', [\App\Http\Controllers\API\BooksController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\API\BooksController::class, 'show']);

    // Filter the relationships of the books by their identifier
    Route::get('/author/{id}', [\App\Http\Controllers\API\BooksController::class, 'author']);
    Route::get('/genre/{id}', [\App\Http\Controllers\API\BooksController::class, 'genre']);
    Route::get('/language/{id}', [\App\Http\Controllers\API\BooksController::class, 'language']);
    Route::get('/translator/{id}', [\App\Http\Controllers\API\BooksController::class, 'translator']);
});

Route::group(['prefix' => 'genres'], function () {
    Route::get('/', [\App\Http\Controllers\API\GenresController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\API\GenresController::class, 'show']);
});

Route::group(['prefix' => 'languages'], function () {
    Route::get('/', [\App\Http\Controllers\API\LanguagesController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\API\LanguagesController::class, 'show']);
});

Route::group(['prefix' => 'sections'], function () {
    Route::get('/', [\App\Http\Controllers\API\SectionsController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\API\SectionsController::class, 'show']);
});

Route::group(['prefix' => 'translators'], function () {
    Route::get('/', [\App\Http\Controllers\API\TranslatorsController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\API\TranslatorsController::class, 'show']);
});
