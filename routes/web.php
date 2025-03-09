<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Meetings;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminOrganizationsController;
use App\Http\Controllers\AdminAccountSettingsController;
use App\Http\Controllers\ManagerSignUpController;
use App\Http\Controllers\ManagerHomeController;
use App\Http\Controllers\ManagerMeetingsController;
use App\Http\Controllers\ManagerMembersController;
use App\Http\Controllers\ManagerAccountSettingsController;
use App\Http\Controllers\MemberSignUpController;
use App\Http\Controllers\MemberHomeController;
use App\Http\Controllers\MemberMeetingsController;
use App\Http\Controllers\MemberAccountSettingsController;
use App\Http\Controllers\MessageController;
use Stichoza\GoogleTranslate\GoogleTranslate;
use OpenAI\Client;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

Route::get('/manager_sign_up_form', [ManagerSignUpController::class, 'manager_sign_up_form']);
Route::post('/manager_sign_up_process', [ManagerSignUpController::class, 'manager_sign_up_process']);
Route::get('/member_sign_up_form', [MemberSignUpController::class, 'member_sign_up_form']);
Route::post('/member_sign_up_process', [MemberSignUpController::class, 'member_sign_up_process']);
Route::get('/', [LoginController::class, 'login_form']);
Route::get('/', [LoginController::class, 'login_form'])->name('login');  //for logout
Route::post('/login_process', [LoginController::class, 'login_process']);

Route::post('/api/translate', function (Request $request) {
    // $tr = Meetings::where('id', $request->id)->value('summary');
    try {
        $tr = new GoogleTranslate();
        $tr->setSource('bik', 'fl');
        $tr->setTarget('en');
        $tr->setOptions(['verify' => false]);
        
        $translatedText = $tr->translate($request->text);
        
        return response()->json([
            'translatedText' => $translatedText
        ]);
    } catch (\Exception $e) {
        \Log::error('Translation error: ' . $e->getMessage());
        return response()->json([
            'translatedText' => $request->text
        ]);
    }
})->name('translate');

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboarda', [AdminDashboardController::class, 'admin_dashboard'])->name('admin.dashboard');
    Route::post('/admin/accept_user/{id}', [AdminDashboardController::class, 'accept_user']);
    Route::post('/admin/reject_user/{id}', [AdminDashboardController::class, 'reject_user']);
    Route::get('/organizations', [AdminOrganizationsController::class, 'organizations']);
    Route::post('/admin/switch-role/{manager_id}/{member_id}', [AdminOrganizationsController::class, 'switch_role'])->name('admin.switch_role');
    Route::get('/account_settingsa', [AdminAccountSettingsController::class, 'admin_account_settings'])->name('admin.account_settings');
    Route::put('/update_admin_account_settings', [AdminAccountSettingsController::class, 'update_admin_account_settings']);
    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::middleware('auth:manager')->group(function () {
    Route::get('/home', [ManagerHomeController::class, 'manager_home'])->name('manager.home');
    Route::get('/meetings', [ManagerMeetingsController::class, 'all'])->name('meetings.all');
    Route::get('/meetings/pending', [ManagerMeetingsController::class, 'pending'])->name('meetings.pending');
    Route::get('/meetings/done', [ManagerMeetingsController::class, 'done'])->name('meetings.done');
    Route::get('meetings/search', [ManagerMeetingsController::class, 'manager_meetings'])->name('search');
    Route::post('/add_meeting', [ManagerMeetingsController::class, 'add_meeting']);
    Route::get('/edit_notes/{id}', [ManagerMeetingsController::class, 'edit_notes'])->name('edit_notes');
    Route::get('/convertt-to-pdf/{id}', [ManagerMeetingsController::class, 'manager_convert_to_pdf'])->name('convert_to_pdf_manager');
    Route::delete('/delete_meeting/{id}', [ManagerMeetingsController::class, 'delete_meeting']);
    Route::put('/update_meeting/{id}', [ManagerMeetingsController::class, 'update_meeting']);
    Route::post('/add_attendance/{meeting_id}', [ManagerMeetingsController::class, 'meetings_attendance'])->name('meetings.attendance.store');
    Route::put('/archive_meeting/{id}', [ManagerMeetingsController::class, 'archive_meeting'])->name('archive_meeting');
    Route::get('/members', [ManagerMembersController::class, 'members_table']);
    Route::post('/add_member', [ManagerMembersController::class, 'add_member']);
    Route::post('/remove_member/{id}', [ManagerMembersController::class, 'remove_member'])->name('remove.member');
    Route::get('/account_settings', [ManagerAccountSettingsController::class, 'manager_account_settings'])->name('manager.account_settings');
    Route::put('/update_manager_account_settings', [ManagerAccountSettingsController::class, 'update_manager_account_settings']);
    Route::get('/logout', [LoginController::class, 'logout']);
    // save message
    Route::post('/edit_notes/save_message', [MessageController::class, 'saveMessage'])->name('save_message.manager');
});

Route::middleware('auth:member')->group(function () {
    Route::get('/homem', [MemberHomeController::class, 'member_home'])->name('member.home');
    Route::get('/meetingsm', [MemberMeetingsController::class, 'member_meetings'])->name('member.meetings.all');
    Route::get('/meetingsm/pending', [MemberMeetingsController::class, 'member_meetings_pending'])->name('member.meetings.pending');
    Route::get('/meetingsm/done', [MemberMeetingsController::class, 'member_meetings_done'])->name('member.meetings.done');
    Route::get('/edit_notes_member/{id}', [MemberMeetingsController::class, 'edit_notes_member']);
    Route::get('/convert-to-pdf/{id}', [MemberMeetingsController::class, 'member_convert_to_pdf'])->name('convert_to_pdf_member');
    Route::put('/update_meeting_member/{id}', [MemberMeetingsController::class, 'update_meeting_member']);
    Route::post('/meetings/{meeting_id}/approve', [MemberMeetingsController::class, 'meeting_approval']);
    Route::get('/account_settingsm', [MemberAccountSettingsController::class, 'member_account_settings'])->name('member.account_settings');
    Route::put('/update_member_account_settings', [MemberAccountSettingsController::class, 'update_member_account_settings']);
    Route::get('/logout', [LoginController::class, 'logout']);    
});
// save and fetch
Route::post('/save_message', [MessageController::class, 'saveMessage'])->name('save_message');
Route::get('/fetch_messages', [MessageController::class, 'fetchMessages'])->name('fetch.messages');





