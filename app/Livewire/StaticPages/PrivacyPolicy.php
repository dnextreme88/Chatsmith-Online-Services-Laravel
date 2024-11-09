<?php

namespace App\Livewire\StaticPages;

use Livewire\Component;

class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.static-pages.privacy-policy')->layout('layouts.guest');
    }
}
