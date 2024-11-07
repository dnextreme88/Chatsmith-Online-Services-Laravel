<?php

namespace App\Livewire\StaticPages;

use Livewire\Component;

class Careers extends Component
{
    public function render()
    {
        return view('livewire.static-pages.careers')->layout('layouts.guest');
    }
}
