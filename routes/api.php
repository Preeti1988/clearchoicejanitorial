<?php

use App\Http\Controllers\Api\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Models\User;

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
Route::get('designation', [UserController::class, 'designation']);
Route::post('submit-review', [UserController::class, 'submit_review']);
Route::post('forget-password', [UserController::class, 'forget_password']);
Route::post('reset-password', [UserController::class, 'reset_password']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserController::class, 'userDetails']);
    Route::post('update-profile', [UserController::class, 'updateProfile']);
    Route::post('home', [UserController::class, 'home']);
    Route::post('services', [UserController::class, 'services']);
    Route::post('service-details', [UserController::class, 'service_details']);
    Route::post('update-status', [UserController::class, 'UpdateStatus']);
    Route::post('update-service-item-status', [UserController::class, 'UpdateServiceItemsStatus']);
    Route::post('feedback', [UserController::class, 'service_rating']);

    Route::get('DateOfWeek', [UserController::class, 'DateOfWeek']);
    Route::post("service-list", [UserController::class, 'sevice_list']);
    Route::post("submit-chat-count", [UserController::class, 'submit_chat_count']);
    Route::post("update-chat-count", [UserController::class, 'update_chat_count']);
    Route::post("service_timecard", [UserController::class, 'sevice_timecard']);
    Route::post("uploadchatimage", [UserController::class, 'uploadchatimage']);
    Route::get("service-logs", [UserController::class, 'serviceLogs']);
    Route::get("incompleted-services", [UserController::class, 'incompleteServices']);

    Route::get("notifications", [NotificationController::class, 'index']);

    Route::post("notifications/read", [NotificationController::class, 'read']);


    // timesheet approval requests
    Route::post("timesheet-request", [UserController::class, 'timesheet_request']);
});