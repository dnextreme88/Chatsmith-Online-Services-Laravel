<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;

class IndexController extends Controller
{
    public function index() {
        $announcements = Announcement::all();
        $user = Auth::user();

        return view('index', [
            'announcements' => $announcements,
            'user' => $user,
        ]);
    }
}
