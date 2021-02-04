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
    Route::get('/', [\App\Http\Controllers\API\Authors::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\API\Authors::class, 'show']);
});
