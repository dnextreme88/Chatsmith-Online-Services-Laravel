<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class UpdateProfileImage extends Component
{
    use WithFileUploads;

    public $photo;

    public function render()
    {
        $user = Auth::user();

        return view('livewire.profile.update-profile-image-form', [
            'user' => $user,
            'is_using_default_image' => $user->profile_image == 'images\\avatars\\default_avatar.png' ? true : false
        ]);
    }

    public function save()
    {
        $default_avatar_filename = 'default_avatar.png';

        // Validate input
        $this->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $temporary_filename = $this->photo->getFilename();
        $file_extension = substr($temporary_filename, strrpos($temporary_filename, '.'));

        // Generate a filename based on username and unix timestamp
        $image_filename = Auth::user()->username. '_' .time(). $file_extension;

        // Remove old profile image to save space
        if (Auth::user()->profile_image != 'images\\avatars\\' .$default_avatar_filename) {
            unlink(public_path(Auth::user()->profile_image));
        }

        // Upload image to public/app/images/avatars directory
        $this->photo->storeAs('images/avatars', $image_filename, 'real_public');

        // Update profile_image field of user
        Auth::user()->update([
            'profile_image' => 'images\\avatars\\' .$image_filename,
        ]);
        Auth::user()->save();

        $this->photo = false;

        $this->dispatch('image-updated', image: Auth::user()->profile_image);
    }

    public function reset_image()
    {
        $default_avatar_filename = 'default_avatar.png';

        if (Auth::user()->profile_image != 'images\\avatars\\' .$default_avatar_filename) {
            unlink(public_path(Auth::user()->profile_image));
        }

        Auth::user()->update([
            'profile_image' => 'images\\avatars\\' . $default_avatar_filename,
        ]);
        Auth::user()->save();

        // Redirect back to upload page when image has successfully uploaded
        $this->dispatch('image-removed');
    }
}
