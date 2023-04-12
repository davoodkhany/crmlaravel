<?php

use App\Http\Controllers\Api\V1\Public\PhoneController;
use App\Http\Controllers\Api\V1\Public\UserController;
use App\Http\Controllers\Api\V1\Public\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        // return $request->user();
        $user = $request->user();
         return response()->json(['user' => $user], 200);
    });

    Route::POST('/signup', [UserController::class, 'store']);

    Route::post('/verified', [PhoneController::class, 'verified']);

    Route::post('/verifiedcode', [PhoneController::class, 'verifiedCode']);

    Route::resource('/contact', ContactController::class);

    Route::post('/get-user-responible', [ContactController::class ,'getUserResponsible']);









});