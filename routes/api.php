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

use App\Http\Controllers\API\AuthorsController;
use App\Http\Controllers\API\BooksController;
use App\Http\Controllers\API\GenresController;
use App\Http\Controllers\API\LanguagesController;
use App\Http\Controllers\API\SectionsController;
use App\Http\Controllers\API\StatsController;
use App\Http\Controllers\API\TranslatorsController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'stats'], function () {
    Route::get('/', [StatsController::class, 'index']);
});

Route::group(['prefix' => 'authors'], function () {
    Route::get('/', [AuthorsController::class, 'index']);
    Route::get('/{id}', [AuthorsController::class, 'show']);
});

Route::group(['prefix' => 'books'], function () {
    Route::get('/', [BooksController::class, 'index']);
    Route::get('/{id}', [BooksController::class, 'show']);

    // Filter the relationships of the books by their identifier
    Route::get('/author/{id}', [BooksController::class, 'author']);
    Route::get('/genre/{id}', [BooksController::class, 'genre']);
    Route::get('/language/{id}', [BooksController::class, 'language']);
    Route::get('/translator/{id}', [BooksController::class, 'translator']);
});

Route::group(['prefix' => 'genres'], function () {
    Route::get('/', [GenresController::class, 'index']);
    Route::get('/{id}', [GenresController::class, 'show']);
});

Route::group(['prefix' => 'languages'], function () {
    Route::get('/', [LanguagesController::class, 'index']);
    Route::get('/{id}', [LanguagesController::class, 'show']);
});

Route::group(['prefix' => 'sections'], function () {
    Route::get('/', [SectionsController::class, 'index']);
    Route::get('/{id}', [SectionsController::class, 'show']);
});

Route::group(['prefix' => 'translators'], function () {
    Route::get('/', [TranslatorsController::class, 'index']);
    Route::get('/{id}', [TranslatorsController::class, 'show']);
});
