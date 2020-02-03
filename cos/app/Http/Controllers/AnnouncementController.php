<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Announcement;

class AnnouncementController extends Controller
{
    public function index () {
    	$announcements = Announcement::paginate(5);
    	$user = Auth::user();

    	return view('announcements', [
    		'announcements' => $announcements,
    		'user' => $user
    	]);
    }

    public function store (Request $request) {
		// process in adding announcement
		$user = Auth::user();

		if ($user->is_staff == 'True') {
			$user = Auth::user();
			$validator = Validator::make($request->all() , 
			[
				'title' => 'required|unique:announcements',
				'description' => 'required',
			]);

			if ($validator->fails()) {
				return redirect("announcements/create")->withErrors($validator)->withInput();
			}

			Announcement::create([
				'user_id' => $user->id,
				'title' => $request->title,
				'description' => $request->description,
			]);

			return redirect()->back()->withSuccess('Announcement successfully added!');

		} else {
			abort(403, 'Forbidden page.');
		}
	}

	public function create () {
		// show add announcements form
		return view('add_announcement_form');
	}
}
