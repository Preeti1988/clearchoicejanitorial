<?php

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
Route::get('/addmember', [App\Http\Controllers\HomeController::class, 'add_member'])->name('AddMember');
Route::get('/addclient', [App\Http\Controllers\HomeController::class, 'add_client'])->name('Addclient');
Route::get('/member-request-detail/{id}', [App\Http\Controllers\HomeController::class, 'member_request_detail'])->name('MemberRequestDetail');
Route::get('/delete-master-item/{type}/{id}', [App\Http\Controllers\HomeController::class, 'delete_master_items'])->name('DeleteItems');

Route::get('/approve-member/{id}', [App\Http\Controllers\HomeController::class, 'approve_member'])->name('ApproveMember');
Route::get('/reject-member/{id}', [App\Http\Controllers\HomeController::class, 'reject_member'])->name('RejectMember');
Route::get('/member-requests', [App\Http\Controllers\HomeController::class, 'member_request'])->name('MemberRequest');
Route::post('/save-client', [App\Http\Controllers\HomeController::class, 'SaveClient'])->name('SaveClient');
Route::get('/edit-teammember/{id}', [App\Http\Controllers\HomeController::class, 'EditTeamMember'])->name('EditTeamMember');
Route::get('/edit-client/{id}', [App\Http\Controllers\HomeController::class, 'EditClient'])->name('EditClient');
Route::post('/save-teammember', [App\Http\Controllers\HomeController::class, 'SaveTeamMember'])->name('SaveTeamMember');
Route::post('/update-teammember', [App\Http\Controllers\HomeController::class, 'UpdateTeamMember'])->name('UpdateTeamMember');
Route::post('/update-client', [App\Http\Controllers\HomeController::class, 'UpdateClient'])->name('UpdateClient');
Route::post('/update-user', [App\Http\Controllers\HomeController::class, 'Updateuser'])->name('UpdateUser');
Route::post('/update-password', [App\Http\Controllers\HomeController::class, 'changeSetting'])->name('changeSetting');
Route::post('/save-master', [App\Http\Controllers\HomeController::class, 'Savemaster'])->name('SaveMaster');
Route::match(['get', 'post'], '/search-team-member-active', [App\Http\Controllers\HomeController::class, 'team_active'])->name('search.team-member-active');
Route::match(['get', 'post'], '/search-team-member-inactive', [App\Http\Controllers\HomeController::class, 'team_inactive'])->name('search.team-member-inactive');
Route::match(['get', 'post'], '/search-team-member', [App\Http\Controllers\HomeController::class, 'team'])->name('search.team-member');


// services all functionality
Route::resource("services", ServiceController::class);
Route::get("assign-member/{id}", [ServiceController::class, 'assignMember'])->name('services.assign');
Route::post("assign-member", [ServiceController::class, 'assignMemberPost'])->name('services.assign.post');


// Listing Ajax request
Route::get("fetch-client", [AjaxController::class, 'fetchClient'])->name('fetchClient');
Route::get("search-user", [AjaxController::class, 'searchUser'])->name('searhcUser');