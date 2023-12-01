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
    Route::post('update-profile', [UserController::class, 'updateProfile']);
    Route::post('home', [UserController::class, 'home']);
    Route::post('services', [UserController::class, 'services']);
    Route::post('service-details', [UserController::class, 'service_details']);
    Route::post('update-status', [UserController::class, 'UpdateStatus']);
    Route::post('submit-review', [UserController::class, 'submit_review']);
    Route::get('DateOfWeek', [UserController::class, 'DateOfWeek']);
    //Route::post("service_timecard", [UserController::class, 'sevice_timecard']);
});