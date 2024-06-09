<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Announcement;
use App\Models\User;

class AnnouncementController extends Controller
{
    // The user must be logged in to access the views
    public function __construct() {
        $this->middleware('auth');
    }

    public function index () {
        $announcements = Announcement::paginate(5);
        $user = Auth::user();
        $layout = '';

        if ($user) {
            if ($user->is_staff == 'True') {
                $layout = 'layouts.admin_panel';
            } elseif ($user->is_staff == 'False') {
                $layout = 'layouts.app';
            }
        } else {
            $layout = 'layouts.app';
        }

        return view('Components.Announcements.get_all', [
            'announcements' => $announcements,
            'user' => $user,
            'layout' => $layout,
        ]);
    }

    public function show ($id) {
        // Show specific announcement
        $current_announcement = Announcement::find($id);
        $previous_announcement = Announcement::where('id', '<', $current_announcement->id)->orderBy('id', 'desc')->first();
        $next_announcement = Announcement::where('id', '>', $current_announcement->id)->orderBy('id')->first();
        $user = Auth::user();
        $layout = '';

        if ($user) {
            if ($user->is_staff == 'True') {
                $layout = 'layouts.admin_panel';
            } elseif ($user->is_staff == 'False') {
                $layout = 'layouts.app';
            }
        } else {
            $layout = 'layouts.app';
        }

        return view('Components.Announcements.detail', [
            'current_announcement' => $current_announcement,
            'next_announcement' => $next_announcement,
            'previous_announcement' => $previous_announcement,
            'user' => $user,
            'layout' => $layout,
        ]);
    }

    public function destroy ($id) {
        // Delete announcement
        $user = Auth::user();

        if ($user->is_staff == 'True') {
            $announcement = Announcement::find($id);
            $announcement->delete();
            // Get URL of certain controller with view method and pass parameters
            $controller_url = action('AnnouncementController@show', ['announcement' => $id]);
            // Get current URL
            $current_url = url()->current();

            $announcements = Announcement::paginate(5);
            $user = Auth::user();

            // If admin is deleting an announcement from /announcement/{id}/, execute this clause
            if ($controller_url == $current_url) {
                return redirect('/announcements/')->withSuccess('Announcement successfully deleted!')
                    ->with('announcements', $announcements)
                    ->with('user', $user);
            // If admin is deleting an announcement from /announcements/, execute this clause
            } else {
                return redirect()->back()->withSuccess('Announcement successfully deleted!');
            }
        } else {
            abort(403, 'Forbidden page.');
        }
    }

    public function show_announcement_by_username ($username) {
        // Show announcements by user
        $user = Auth::user();
        $find_user_by_username = User::where('username', $username)->first();
        $announcements_of_user = Announcement::where('user_id', '=', $find_user_by_username->id)->orderBy('user_id', 'desc')->paginate(5);
        $layout = '';

        if ($user) {
            if ($user->is_staff == 'True') {
                $layout = 'layouts.admin_panel';
            } elseif ($user->is_staff == 'False') {
                $layout = 'layouts.app';
            }
        } else {
            $layout = 'layouts.app';
        }

        return view('Components.Announcements.get_all_by_username', [
            'user' => $user,
            'user_by_username' => $find_user_by_username,
            'announcements' => $announcements_of_user,
            'layout' => $layout,
        ]);
    }
}
