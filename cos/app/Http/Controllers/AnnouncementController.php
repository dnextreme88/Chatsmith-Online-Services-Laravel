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
	}

	public function create () {
		// show add announcements form
		$user = Auth::user();

		if ($user->is_staff == 'True') {
			return view('add_announcement_form');
		} else {
			abort(403, 'Forbidden page.');
		}
	}

	public function show ($id) {
		// show specific announcement
		$current_announcement = Announcement::find($id);
		$previous_announcement = Announcement::where('id', '<', $current_announcement->id)->orderBy('id','desc')->first();
		$next_announcement = Announcement::where('id', '>', $current_announcement->id)->orderBy('id')->first();
		$user = Auth::user();

		return view('show_announcement', [
			"current_announcement" => $current_announcement,
			"next_announcement" => $next_announcement,
			"previous_announcement" => $previous_announcement,
			"user" => $user
		]);
	}

	public function edit ($id) {
		// show edit announcement form
		$announcement = Announcement::find($id);

		return view('edit_announcement_form', [
			"announcement" => $announcement,
		]);
	}

	public function update (Request $request, $id) {
		// process in updating announcement
		$announcement = Announcement::find($id);

		$validator = Validator::make($request->all() , 
		[
			'title' => 'unique:announcements,id,' .$announcement->id,
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$announcement->user_id = $announcement->user_id;
		$announcement->title = $request->title;
		$announcement->description = $request->description;
		$announcement->save();

		return redirect()->back()->withSuccess('Announcement successfully edited!');
	}

	public function destroy ($id) {
		// delete announcement
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
					->with("announcements", $announcements)
					->with("user", $user);
			// If admin is deleting an announcement from /announcements/, execute this clause
			} else {
				return redirect()->back()->withSuccess('Announcement successfully deleted!');
			}
		} else {
			abort(403, 'Forbidden page.');
		}
	}
}
