<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TimeRecord;
use Carbon\Carbon;

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
        $user = Auth::user();

        return view('pages.profile', [
            'user' => $user
        ]);
    }

    public function show_update_profile_image_form () {
        $user = Auth::user();

        return view('update_profile_image_form', [
            'user' => $user
        ]);
    }

    public function update_time_record (Request $request, $id) {
        // Process in updating time record
        $time_record = TimeRecord::find($id);
        $time_record->timestamp_out = Carbon::now();
        $time_record->save();

        return redirect()->back()->withSuccess('You have successfully clocked out!');
    }
}
