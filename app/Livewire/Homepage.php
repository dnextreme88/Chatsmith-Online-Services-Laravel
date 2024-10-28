<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Homepage extends Component
{
    public function render()
    {
        $layout_to_use = Auth::check() ? config('livewire.layout') : 'layouts.guest'; // Because we use this component for both authenticated employees and guests

        return view('livewire.homepage')->layout($layout_to_use);
    }
}
