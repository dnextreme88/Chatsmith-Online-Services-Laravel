<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // The user must be logged in to access the views
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.dashboard');
    }

    public function profile () {
        return view('pages.profile', [
            'user' => Auth::user()
        ]);
    }

    public function show_update_profile_image_form () {
        return view('update_profile_image_form', [
            'user' => Auth::user()
        ]);
    }
}
