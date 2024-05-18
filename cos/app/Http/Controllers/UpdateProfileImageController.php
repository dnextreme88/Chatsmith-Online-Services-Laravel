<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Image;

class UpdateProfileImageController extends Controller
{
    // The user must be logged in to access the views
    public function __construct() {
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
        $default_avatar_filename = 'default_avatar.png';
        // Get name of submit buttons
        $removeImageButton = $request->input('removeImage');
        $uploadButton = $request->input('uploadImage');

        if (isset($uploadButton)) { // When Upload Image is clicked
            // Validate input
            $this->validate($request, [
                'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            // Get uploaded file
            $image = $request->file('select_file');
            // Generate a filename based on username and unix timestamp
            $image_filename = $user->username . '_' . time() . '.' . $image->getClientOriginalExtension();
            // Resize image
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(180, 180, function ($constraint) {
                $constraint->aspectRatio();
            });
            // Upload image to public/images/avatars directory
            $resize_image->save(public_path('/images/avatars') . '/' . $image_filename);
            // Remove old profile image to save space
            if ($user->profile_image != 'images\\avatars\\' . $default_avatar_filename) {
                unlink(public_path($user->profile_image));
            }
            // Update profile_image field of user
            $user->profile_image = 'images\\avatars\\' . $image_filename;
            $user->save();
            // Redirect back to upload page when image has successfully uploaded
            return back()->withSuccess('Image uploaded successfully');
        } elseif (isset($removeImageButton)) { // When Remove Profile Image is clicked
            unlink(public_path($user->profile_image));
            $user->profile_image = 'images\\avatars\\' . $default_avatar_filename;
            $user->save();
            // Redirect back to upload page when image has successfully uploaded
            return back()->withSuccess('Image removed successfully! Your profile image is now set to default.');
        }
    }
}
