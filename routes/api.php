<?php

use App\Http\Controllers\Api\V1\Public\ContactController;
use App\Http\Controllers\Api\V1\Public\UserController;

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

Route::prefix('v1')->group(function () {

    Route::post('/signup', [UserController::class, 'store']);

    // Route::post('/verified', [PhoneController::class, 'verified']);

    // Route::post('/verifiedcode', [PhoneController::class, 'verifiedCode']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::resource('/contact', ContactController::class);
        Route::post('/get-user-responible', [ContactController::class, 'getUserResponsible']);
    });

});