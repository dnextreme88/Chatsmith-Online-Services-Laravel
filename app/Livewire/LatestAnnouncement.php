<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;

class LatestAnnouncement extends Component
{
    public $latest_announcement;

    public function render()
    {
        $this->latest_announcement = Announcement::latest()
            ->first();

        return view('livewire.latest-announcement');
    }
}
