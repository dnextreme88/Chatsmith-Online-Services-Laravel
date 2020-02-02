<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Image;

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
		// Generate a filename based on username and unix timestamp
		$image_filename = $user->username. '_' .time() . '.' .$image->getClientOriginalExtension();
		// Resize image 
		$resize_image = Image::make($image->getRealPath());
		$resize_image->resize(180, 180, function ($constraint) {
			$constraint->aspectRatio();
		});
		// Upload image to public/images/ directory
		$resize_image->save(public_path('/images') . '/' . $image_filename);
		// Temporarily store old profile image when new image has successfully uploaded
		$old_profile_image = $user->profile_image;
		// Update profile_image field of user
		$user->profile_image = 'images\\'. $image_filename;
		$new_profile_image = $user->profile_image;
		$user->save();
		// Redirect back to upload page when image has successfully uploaded
		return back()->withSuccess('Image uploaded successfully')
			->with('new_profile_image', $new_profile_image)
			->with('old_profile_image', $old_profile_image);
	}
}
