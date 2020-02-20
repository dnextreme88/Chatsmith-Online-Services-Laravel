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

Route::get('/admin', 'AdminPanelController@index');

Route::get('/daily_productions', 'DailyProductionController@index');

Route::get('/users', 'UserController@index');

Route::resource('announcements', 'AnnouncementController');

Route::get('announcements/user/{username}', 'AnnouncementController@show_announcement_by_username');

Route::resource('employees', 'EmployeeController');

Route::get('/profile', 'ProfileController@index')->name('profile');

Route::get('/profile/{id}/edit', 'ProfileController@edit_user_settings');

Route::post('/profile/{id}/edit', 'ProfileController@update_user_settings');

Route::post('/profile/create_time_record', 'ProfileController@create_time_record');

Route::post('/profile/time_record/{id}', 'ProfileController@update_time_record');

Route::get('user/update_profile_image', 'UpdateProfileImageController@index');

Route::post('user/update_profile_image/{id}', 'UpdateProfileImageController@upload');

Route::get('/leadforms/chat_account', 'LeadformController@create_chat_account_leadform');

Route::post('/leadforms/chat_account', 'LeadformController@store_chat_account_leadform');

Route::get('/leadforms/focal', 'LeadformController@create_focal_leadform');

Route::post('/leadforms/focal', 'LeadformController@store_focal_leadform');

Route::get('/leadforms/plateiq', 'LeadformController@create_plateiq_leadform');

Route::post('/leadforms/plateiq', 'LeadformController@store_plateiq_leadform');

// Static pages

Route::get('/aboutus', 'AboutUsController@index');

Route::get('/careers', 'CareersController@index');

Route::get('/privacy', 'PrivacyController@index');

Route::get('/terms', 'TermsAndConditionsController@index');
