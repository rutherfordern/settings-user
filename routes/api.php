<?php

use App\Http\Controllers\Web\Api\AuthController;
use App\Http\Controllers\Web\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api'], function ($router) {

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });

    Route::group(['middleware' => 'jwt.auth'], function() {

        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileController::class, 'me']);
            Route::post('/edit/nickname', [ProfileController::class, 'changeNickname']);
            Route::post('/verify-change-nickname', [ProfileController::class, 'verifyChangeNickname']);
            Route::post('/edit/verification-method', [ProfileController::class, 'changeVerificationMethod']);
        });
    });
});
