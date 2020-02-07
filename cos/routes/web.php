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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminPanelController@index');

Route::get('/users', 'UserController@index');

Route::resource('announcements', 'AnnouncementController');

Route::get('announcements/user/{username}', 'AnnouncementController@show_announcement_by_username');

Route::resource('employees', 'EmployeeController');

Route::resource('profile', 'ProfileController');

Route::get('user/update_profile_image', 'UpdateProfileImageController@index');

Route::post('user/update_profile_image/{id}', 'UpdateProfileImageController@upload');

// Static pages

Route::get('/aboutus', 'AboutUsController@index');

Route::get('/careers', 'CareersController@index');

Route::get('/privacy', 'PrivacyController@index');

Route::get('/terms', 'TermsAndConditionsController@index');
