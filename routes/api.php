<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
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

 
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('country', [UserController::class, 'country']);
Route::post('state', [UserController::class, 'state']);
Route::post('city', [UserController::class, 'city']);
 
Route::middleware('auth:sanctum')->group(function () {
 Route::get('profile', [UserController::class, 'userDetails']);
});
