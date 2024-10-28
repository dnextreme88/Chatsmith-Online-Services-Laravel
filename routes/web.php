<?php

use App\Livewire\CreateContactUs;
use App\Livewire\DetailAnnouncement;
use App\Livewire\Homepage;
use App\Livewire\ListAnnouncements;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function() {
    return view('welcome');
});
*/

Route::get('/', Homepage::class)->name('home');

Route::get('/contact_us', CreateContactUs::class)->name('contact_us');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function() {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'announcements', 'as' => 'announcements.'], function() {
        Route::get('/', ListAnnouncements::class)->name('index');
        Route::get('/{id}', DetailAnnouncement::class)->name('detail');
    });

    Route::get('/leadforms', function() {
        return view('leadforms');
    })->name('leadforms');
});
