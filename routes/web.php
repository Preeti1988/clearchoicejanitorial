<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Models\Service;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Route::get("update-service", function () {
    $services = Service::whereDate("scheduled_end_date", "<", now())->get();
    foreach ($services as $item) {
        $item->status = "completed";
        $item->save();
    }
    return redirect(route("Home"));
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
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
    Route::get('/timecard/{id}', [App\Http\Controllers\HomeController::class, 'timecard'])->name('timecard');

    Route::get('/approve-member/{id}', [App\Http\Controllers\HomeController::class, 'approve_member'])->name('ApproveMember');
    Route::get('/reject-member/{id}', [App\Http\Controllers\HomeController::class, 'reject_member'])->name('RejectMember');
    Route::get('/member-requests', [App\Http\Controllers\HomeController::class, 'member_request'])->name('MemberRequest');
    Route::post('/save-client', [App\Http\Controllers\HomeController::class, 'SaveClient'])->name('SaveClient');
    Route::get('/edit-teammember/{id}', [App\Http\Controllers\HomeController::class, 'EditTeamMember'])->name('EditTeamMember');
    Route::get('/edit-client/{id}', [App\Http\Controllers\HomeController::class, 'EditClient'])->name('EditClient');
    Route::get('/add-teammember', [App\Http\Controllers\HomeController::class, 'AddTeamMember'])->name('AddTeamMember');

    Route::post('/save-teammember', [App\Http\Controllers\HomeController::class, 'SaveTeamMember'])->name('SaveTeamMember');
    Route::post('/update-teammember', [App\Http\Controllers\HomeController::class, 'UpdateTeamMember'])->name('UpdateTeamMember');
    Route::post('/update-client', [App\Http\Controllers\HomeController::class, 'UpdateClient'])->name('UpdateClient');
    Route::post('/update-user', [App\Http\Controllers\HomeController::class, 'Updateuser'])->name('UpdateUser');
    Route::post('/update-password', [App\Http\Controllers\HomeController::class, 'changeSetting'])->name('changeSetting');
    Route::post('/save-master', [App\Http\Controllers\HomeController::class, 'Savemaster'])->name('SaveMaster');
    Route::post('/update-master', [App\Http\Controllers\HomeController::class, 'UpdateMaster'])->name('UpdateMaster');

    Route::match(['get', 'post'], '/search-team-member-active', [App\Http\Controllers\HomeController::class, 'team_active'])->name('search.team-member-active');
    Route::match(['get', 'post'], '/search-team-member-inactive', [App\Http\Controllers\HomeController::class, 'team_inactive'])->name('search.team-member-inactive');
    Route::match(['get', 'post'], '/search-team-member', [App\Http\Controllers\HomeController::class, 'team'])->name('search.team-member');
    Route::match(['get', 'post'], '/chats', [App\Http\Controllers\HomeController::class, 'chats'])->name('Chats');
    Route::match(['get', 'post'], '/chat/{id}', [App\Http\Controllers\HomeController::class, 'chatsID'])->name('ChatsID');
    Route::get('/submit-chat-count', [App\Http\Controllers\HomeController::class, 'submit_chat_count'])->name('SubmitChatCount');
    Route::post('/update-chat-count', [App\Http\Controllers\HomeController::class, 'update_chat_count'])->name('UpdateChatCount');
    Route::post('/support-save-img', [App\Http\Controllers\HomeController::class, 'help_support_save_img'])->name('SA.HelpSupport.Save.Img');


    // services all functionality
    Route::resource("services", ServiceController::class);
    Route::get("service-scheduler", [ServiceController::class, 'serviceScheduler'])->name('services.scheduler');
    Route::get("assign-member/{id}", [ServiceController::class, 'assignMember'])->name('services.assign');
    Route::post("assign-member", [ServiceController::class, 'assignMemberPost'])->name('services.assign.post');

    Route::get("privacy", [SettingController::class, 'privacy'])->name('privacy');
    Route::post("privacy", [SettingController::class, 'privacySave'])->name('privacy.save');

    Route::get("terms", [SettingController::class, 'terms'])->name('terms');
    Route::post("terms", [SettingController::class, 'termsSave'])->name('terms.save');
});
// Listing Ajax request
Route::get("fetch-client", [AjaxController::class, 'fetchClient'])->name('fetchClient');
Route::get("search-user", [AjaxController::class, 'searchUser'])->name('searhcUser');
Route::get("get-state", [AjaxController::class, 'getState'])->name('getState');
Route::get("get-city", [AjaxController::class, 'getCity'])->name('getCity');
Route::post("get-country", [AjaxController::class, 'getCountry'])->name('getCountry');


Route::post('upload-image', [AjaxController::class, 'uploadImage'])->name('image-upload');
Route::post('delete-image', [AjaxController::class, 'deleteImage'])->name('image-delete');
Route::post('update-status', [AjaxController::class, 'updateStatus'])->name('updateStatus');
