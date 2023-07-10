<?php

# /api/auth
use App\Http\Controllers\Auth\ApiAuthenticationController;

Route::group(['prefix' => 'auth'], function () {
    #login
    Route::post('login', [ApiAuthenticationController::class, 'authenticate']);
    Route::get('logout', [ApiAuthenticationController::class, 'logout']);
});
