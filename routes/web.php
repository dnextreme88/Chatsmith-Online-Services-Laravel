<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DailyProductionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LeadformController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UpdateProfileImageController;
use App\Http\Controllers\UserController;

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

Route::get('/', [IndexController::class, 'index']);

Route::resource('schedules', ScheduleController::class, ['except' => ['destroy']]);

Route::post('schedule', [ScheduleController::class, 'store'])->name('schedules.store');

Route::post('schedules/employees/{employee_id}/{schedule_id}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

Route::get('schedules/employees/{id}', [ScheduleController::class, 'show_schedule_of_employee']);

Route::post('schedules/employees/{id}', [ScheduleController::class, 'filter_schedule_of_employee']);

Route::post('schedules/', [ScheduleController::class, 'view_schedule_by_week'])->name('view_schedule_by_week');

Route::resource('tasks', TaskController::class);

Route::post('task', [TaskController::class, 'store'])->name('tasks.store');

Route::post('tasks/', [TaskController::class, 'view_task_by_day'])->name('view_task_by_day');

Route::get('/admin', [AdminPanelController::class, 'index'])->name('admin_panel_home');

Route::get('/daily_productions', [DailyProductionController::class, 'index'])->name('daily_productions');

Route::get('/users', [UserController::class, 'index'])->name('all_users');

Route::resource('announcements', AnnouncementController::class);

Route::get('announcements/user/{username}', [AnnouncementController::class, 'show_announcement_by_username']);

Route::resource('employees', EmployeeController::class);

Route::get('employees/search/query', [EmployeeController::class, 'search_employees'])->name('search_employees');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/profile/{id}/edit', [ProfileController::class, 'edit_user_settings']);

Route::post('/profile/{id}/edit', [ProfileController::class, 'update_user_settings']);

Route::post('/profile/create_time_record', [ProfileController::class, 'create_time_record'])->name('create_time_record');

Route::post('/profile/time_record/{id}', [ProfileController::class, 'update_time_record']);

Route::get('user/update_profile_image', [UpdateProfileImageController::class, 'index'])->name('update_profile_image');

Route::post('user/update_profile_image/{id}', [UpdateProfileImageController::class, 'upload']);

Route::get('/leadforms/chat_account', [LeadformController::class, 'create_chat_account_leadform'])->name('chat_account_leadform');

Route::post('/leadforms/chat_account', [LeadformController::class, 'store_chat_account_leadform']);

Route::get('/leadforms/focal', [LeadformController::class, 'create_focal_leadform'])->name('focal_leadform');

Route::post('/leadforms/focal', [LeadformController::class, 'store_focal_leadform']);

Route::get('/leadforms/plateiq', [LeadformController::class, 'create_plateiq_leadform'])->name('plate_leadform');

Route::post('/leadforms/plateiq', [LeadformController::class, 'store_plateiq_leadform']);

// Static pages
Route::get('/aboutus', [StaticPagesController::class, 'about_us_index']);

Route::get('/careers', [StaticPagesController::class, 'careers_index']);

Route::get('/privacy', [StaticPagesController::class, 'privacy_index']);

Route::get('/terms', [StaticPagesController::class, 'terms_and_conditions_index']);