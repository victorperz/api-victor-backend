<?php

use App\Http\Controllers\GetUrlsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware(['parenthesis'])->group(function () {
    Route::group([
       'prefix' => '/v1'
    ], function () {
        Route::post('short-urls', GetUrlsController::class)
            ->name('api.v1.urls');
    });
});