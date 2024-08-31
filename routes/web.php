<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\TaskController;
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

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::resource('schedules', ScheduleController::class, ['except' => ['destroy']]);

Route::get('schedules/employees/{id}', [ScheduleController::class, 'show_schedule_of_employee']);

Route::post('schedules/employees/{id}', [ScheduleController::class, 'filter_schedule_of_employee']);

Route::post('schedules/', [ScheduleController::class, 'view_schedule_by_week'])->name('view_schedule_by_week');

Route::resource('tasks', TaskController::class);

Route::post('task', [TaskController::class, 'store'])->name('tasks.store');

Route::post('tasks/', [TaskController::class, 'view_task_by_day'])->name('view_task_by_day');

/*
Route::get('/admin', [AdminPanelController::class, 'index'])->name('admin_panel_home');
*/

Route::get('/users', [UserController::class, 'index'])->name('all_users');

// Announcement routes
Route::group(['prefix' => 'announcements', 'as' => 'announcements.'], function() {
    Route::get('/', [AnnouncementController::class, 'index'])->name('index');
    Route::get('/{id}', [AnnouncementController::class, 'show'])->name('detail');
    Route::get('/users/{username}', [AnnouncementController::class, 'show_announcement_by_username'])->name('show_by_username');
});

// Employee routes
Route::group(['prefix' => 'employees', 'as' => 'employees.'], function() {
    Route::get('/{id}', [EmployeeController::class, 'show'])->name('detail');
});

// Production routes
Route::group(['prefix' => 'productions', 'as' => 'productions.'], function() {
    Route::get('/daily', [ProductionController::class, 'daily_productions'])->name('daily');
    Route::get('/leadforms/chat_account', [ProductionController::class, 'chat_account_leadform'])->name('leadforms.chat_account')->middleware('auth');
    Route::get('/leadforms/focal', [ProductionController::class, 'focal_leadform'])->name('leadforms.focal')->middleware('auth');
    Route::get('/leadforms/plateiq', [ProductionController::class, 'plateiq_leadform'])->name('leadforms.plate')->middleware('auth');
});

// Dashboard x Profile routes
Route::group(['middleware' => 'auth', 'prefix' => 'dashboard', 'as' => 'dashboard.'], function() {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/image', [ProfileController::class, 'show_update_profile_image_form'])->name('update_profile_image');
    Route::post('/create_time_record', [ProfileController::class, 'create_time_record'])->name('create_time_record');
    Route::post('/time_record/{id}', [ProfileController::class, 'update_time_record'])->name('update_time_record');
});

// Static pages
Route::get('/aboutus', [StaticPagesController::class, 'about_us_index'])->name('about_us');

Route::get('/careers', [StaticPagesController::class, 'careers_index'])->name('careers');

Route::get('/privacy', [StaticPagesController::class, 'privacy_index'])->name('privacy');

Route::get('/terms', [StaticPagesController::class, 'terms_and_conditions_index'])->name('toc');

require __DIR__.'/auth.php';
