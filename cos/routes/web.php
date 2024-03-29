<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'IndexController@index');

Route::resource('schedules', 'ScheduleController', ['except' => ['destroy']]);

Route::post('schedule', 'ScheduleController@store')->name('schedules.store');

Route::post('schedules/employees/{employee_id}/{schedule_id}', 'ScheduleController@destroy')->name('schedules.destroy');

Route::get('schedules/employees/{id}', 'ScheduleController@show_schedule_of_employee');

Route::post('schedules/employees/{id}', 'ScheduleController@filter_schedule_of_employee');

Route::post('schedules/', 'ScheduleController@view_schedule_by_week')->name('view_schedule_by_week');

Route::resource('tasks', 'TaskController');

Route::post('task', 'TaskController@store')->name('tasks.store');

Route::post('tasks/', 'TaskController@view_task_by_day')->name('view_task_by_day');

Route::get('/admin', 'AdminPanelController@index')->name('admin_panel_home');

Route::get('/daily_productions', 'DailyProductionController@index')->name('daily_productions');

Route::get('/users', 'UserController@index')->name('all_users');

Route::resource('announcements', 'AnnouncementController');

Route::get('announcements/user/{username}', 'AnnouncementController@show_announcement_by_username');

Route::resource('employees', 'EmployeeController');

Route::get('employees/search/query', 'EmployeeController@search_employees')->name('search_employees');

Route::get('/profile', 'ProfileController@index')->name('profile');

Route::get('/profile/{id}/edit', 'ProfileController@edit_user_settings');

Route::post('/profile/{id}/edit', 'ProfileController@update_user_settings');

Route::post('/profile/create_time_record', 'ProfileController@create_time_record')->name('create_time_record');

Route::post('/profile/time_record/{id}', 'ProfileController@update_time_record');

Route::get('user/update_profile_image', 'UpdateProfileImageController@index')->name('update_profile_image');

Route::post('user/update_profile_image/{id}', 'UpdateProfileImageController@upload');

Route::get('/leadforms/chat_account', 'LeadformController@create_chat_account_leadform')->name('chat_account_leadform');

Route::post('/leadforms/chat_account', 'LeadformController@store_chat_account_leadform');

Route::get('/leadforms/focal', 'LeadformController@create_focal_leadform')->name('focal_leadform');

Route::post('/leadforms/focal', 'LeadformController@store_focal_leadform');

Route::get('/leadforms/plateiq', 'LeadformController@create_plateiq_leadform')->name('plate_leadform');

Route::post('/leadforms/plateiq', 'LeadformController@store_plateiq_leadform');

// Static pages

Route::get('/aboutus', 'StaticPagesController@about_us_index');

Route::get('/careers', 'StaticPagesController@careers_index');

Route::get('/privacy', 'StaticPagesController@privacy_index');

Route::get('/terms', 'StaticPagesController@terms_and_conditions_index');
