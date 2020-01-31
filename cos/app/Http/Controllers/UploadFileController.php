<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UploadFileController extends Controller
{
    public function index () {
    	$user = Auth::user();

		return view('upload_avatar_form',
			['user' => $user, 
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
    	// $image_filename = rand() . '.' .$image->getClientOriginalExtension();
    	$image_filename = $user->username. '_' .time() . '.' .$image->getClientOriginalExtension();
    	// Upload image to public/images/ directory
    	$image->move(public_path('images'), $image_filename);
    	$user->profile_image = 'images\\'. $image_filename;
    	$user->save();
    	// Redirect back to upload page when image has successfully uploaded
    	return back()->withSuccess('Image uploaded successfully')->with('path', $image_filename);
    }
}
