<?php

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

//RUTAS PÚBLICAS
require_once "api_routes/auth.routes.php";


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    require_once "api_routes/users.routes.php";
});
