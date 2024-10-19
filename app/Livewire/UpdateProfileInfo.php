<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileInfo extends Component
{
    use WithFileUploads;

    public $user;
    public $uploaded_photo;
    public $user_id;
    public $first_name;
    public $maiden_name;
    public $last_name;
    public $phone_number;
    public $address;

    public function delete_profile_photo()
    {
        if ($this->uploaded_photo || $this->user->profile_photo_path) {
            $this->uploaded_photo = null;
            $this->user->profile_photo_path = null;
        }
    }

    public function update_profile_info(): void
    {
        $this->validate([
            'uploaded_photo' => ['nullable', 'mimes:gif,jpg,jpeg,png', 'max:2048'],
            'first_name' => ['required', 'string', 'min:2'],
            'maiden_name' => ['string', 'min:2'],
            'last_name' => ['required', 'string', 'min:2'],
            'phone_number' => ['required', 'starts_with:+639', 'size:13'],
            'address' => ['required', 'string']
        ]);

        $this->user->updateProfilePhoto($this->uploaded_photo);

        $this->user->update([
            'first_name' => $this->first_name,
            'maiden_name' => $this->maiden_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'address' => $this->address
        ]);

        $this->user->save();

        $this->dispatch('profile-updated');
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->user_id = $this->user->id;
        $this->first_name = $this->user->first_name;
        $this->maiden_name = $this->user->maiden_name;
        $this->last_name = $this->user->last_name;
        $this->phone_number = $this->user->phone_number;
        $this->address = $this->user->address;
    }

    #[On('profile-updated')]
    public function render()
    {
        return view('livewire.update-profile-info');
    }
}
