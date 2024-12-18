<?php

use App\Livewire\CreateContactUs;
use App\Livewire\CreateFormRequest;
use App\Livewire\DetailAnnouncement;
use App\Livewire\Homepage;
use App\Livewire\ListAnnouncements;
use App\Livewire\ListFormRequest;
use App\Livewire\StaticPages\Careers;
use App\Livewire\StaticPages\PrivacyPolicy;
use App\Livewire\StaticPages\TermsAndConditions;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function() {
    return view('welcome');
});
*/

Route::get('/', Homepage::class)->name('home');
Route::get('/careers', Careers::class)->name('careers');
Route::get('/contact-us', CreateContactUs::class)->name('contact_us');
Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy_policy');
Route::get('/terms', TermsAndConditions::class)->name('terms_and_conditions');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function() {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'forms', 'as' => 'forms.'], function() {
        Route::get('/create', CreateFormRequest::class)->name('create');
        Route::get('/my-requests', ListFormRequest::class)->name('list');
    });

    Route::group(['prefix' => 'announcements', 'as' => 'announcements.'], function() {
        Route::get('/', ListAnnouncements::class)->name('index');
        Route::get('/{id}', DetailAnnouncement::class)->name('detail');
    });

    Route::get('/leadforms', function() {
        return view('leadforms');
    })->name('leadforms');
});
