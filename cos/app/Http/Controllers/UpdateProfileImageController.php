<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UpdateProfileImageController extends Controller
{
	// The user must be logged in to access the views
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index () {
		$user = Auth::user();

		return view('update_profile_image_form', [
			'user' => $user, 
		]);
	}

	public function upload (Request $request, $id) {
		$user = User::find($id);
		$this->validate($request, [
			'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
		]);

		// Get uploaded file
		$image = $request->file('select_file');
		// Generate a randomized uploaded file name
		$image_filename = $user->username. '_' .time() . '.' .$image->getClientOriginalExtension();
		// Upload image to public/images/ directory
		$image->move(public_path('images'), $image_filename);
		// Temporarily store old profile image when new image has successfully uploaded
		$old_profile_image = $user->profile_image;
		// Update profile_image field to use the image
		$user->profile_image = 'images\\'. $image_filename;
		$user->save();
		// Redirect back to upload page when image has successfully uploaded
		return back()->withSuccess('Image uploaded successfully')
			->with('path', $image_filename)
			->with('old_profile_image', $old_profile_image);
	}
}
