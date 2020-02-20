<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;

class IndexController extends Controller
{
    public function index() {
    	$announcements = Announcement::all();

    	return view('index', [
    		'announcements' => $announcements,
    	]);
    }
}
