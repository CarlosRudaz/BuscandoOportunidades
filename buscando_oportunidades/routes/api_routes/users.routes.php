<?php

use App\Http\Controllers\User\UsersController;

Route::prefix('users')->group(function () {
    Route::get('current',[UsersController::class,'showCurrentUser']);
    Route::put('current/change-password',[UsersController::class,'changeUserPassword']);
    Route::post('create',[UsersController::class,'store']);
});
