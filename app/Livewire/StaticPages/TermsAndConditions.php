<?php

namespace App\Livewire\StaticPages;

use Livewire\Component;

class TermsAndConditions extends Component
{
    public function render()
    {
        return view('livewire.static-pages.terms-and-conditions')->layout('layouts.guest');
    }
}
