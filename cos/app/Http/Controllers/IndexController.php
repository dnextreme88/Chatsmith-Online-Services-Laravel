<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class IndexController extends Controller
{
    public function index() {
        $announcements = Announcement::all();

        return view('index', [
            'announcements' => $announcements,
        ]);
    }
}
