<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ServiceController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('/convert', function () {
    $admin = User::find(1);
    $admin->password = Hash::make("Beast@203");
    $admin->save();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('Home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('Homes');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('Dashboard');
Route::get('/client', [App\Http\Controllers\HomeController::class, 'clients'])->name('Clients');
Route::get('/client-details/{id}', [App\Http\Controllers\HomeController::class, 'client_details'])->name('ClientDetails');
Route::get('/create-schedular', [App\Http\Controllers\HomeController::class, 'create_schedular'])->name('CreateSchedular');

Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('Profile');
Route::get('/master', [App\Http\Controllers\HomeController::class, 'master'])->name('Master');
Route::get('/teams-active', [App\Http\Controllers\HomeController::class, 'team_active'])->name('TeamActive');
Route::get('/teams-inactive', [App\Http\Controllers\HomeController::class, 'team_inactive'])->name('TeamInactive');
Route::get('/team-detail/{id}', [App\Http\Controllers\HomeController::class, 'team_detail'])->name('TeamDetail');
Route::get('/member-request-detail/{id}', [App\Http\Controllers\HomeController::class, 'member_request_detail'])->name('MemberRequestDetail');

Route::get('/approve-member/{id}', [App\Http\Controllers\HomeController::class, 'approve_member'])->name('ApproveMember');
Route::get('/reject-member/{id}', [App\Http\Controllers\HomeController::class, 'reject_member'])->name('RejectMember');
Route::get('/member-requests', [App\Http\Controllers\HomeController::class, 'member_request'])->name('MemberRequest');
Route::post('/save-client', [App\Http\Controllers\HomeController::class, 'SaveClient'])->name('SaveClient');
Route::post('/save-master', [App\Http\Controllers\HomeController::class, 'Savemaster'])->name('SaveMaster');
Route::match(['get', 'post'], '/search-team-member', [App\Http\Controllers\HomeController::class, 'team'])->name('search.team-member');


// services all functionality
Route::resource("services", ServiceController::class);


// Listing Ajax request
Route::get("fetch-client}", [AjaxController::class, 'fetchClient'])->name('fetchClient');
