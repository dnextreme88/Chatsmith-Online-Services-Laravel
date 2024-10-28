<?php

namespace App\Livewire;

use App\Models\ContactUs;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateContactUs extends Component
{
    public $name;
    public $email;
    public $message;

    public function create_contact_us()
    {
        $this->validate([
            'name' => ['required', 'max:128'],
            'email' => ['required', 'max:128', 'email'],
            'message' => ['required', 'min:2', 'max:255']
        ]);

        ContactUs::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        $this->reset();

        $this->dispatch('contact-us-created');
    }

    #[On('contact-us-created')]
    public function render()
    {
        return view('livewire.create-contact-us')->layout('layouts.guest');
    }
}
