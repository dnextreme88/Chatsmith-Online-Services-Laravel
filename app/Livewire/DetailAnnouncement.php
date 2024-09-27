<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;

class DetailAnnouncement extends Component
{
    public $announcement;

    public function mount($id)
    {
        $this->announcement = Announcement::find($id);;
    }

    public function render()
    {
        return view('livewire.detail-announcement');
    }
}
