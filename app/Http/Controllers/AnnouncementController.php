<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;
use App\Models\User;

class AnnouncementController extends Controller
{
    // The user must be logged in to access the views
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $announcements = Announcement::paginate(5);
        $user = Auth::user();

        return view('Components.Announcements.get_all', [
            'announcements' => $announcements,
            'user' => $user
        ]);
    }

    public function show($id) {
        // Show specific announcement
        $current_announcement = Announcement::find($id);
        $previous_announcement = Announcement::where('id', '<', $current_announcement->id)->orderBy('id', 'desc')->first();
        $next_announcement = Announcement::where('id', '>', $current_announcement->id)->orderBy('id')->first();
        $user = Auth::user();

        return view('Components.Announcements.detail', [
            'current_announcement' => $current_announcement,
            'next_announcement' => $next_announcement,
            'previous_announcement' => $previous_announcement,
            'user' => $user
        ]);
    }

    public function show_announcement_by_username($username) {
        // Show announcements by user
        $user = Auth::user();
        $find_user_by_username = User::where('username', $username)->first();
        $announcements_of_user = Announcement::where('user_id', '=', $find_user_by_username->id)->orderBy('user_id', 'desc')->paginate(5);

        return view('Components.Announcements.get_all_by_username', [
            'user' => $user,
            'user_by_username' => $find_user_by_username,
            'announcements' => $announcements_of_user
        ]);
    }
}
