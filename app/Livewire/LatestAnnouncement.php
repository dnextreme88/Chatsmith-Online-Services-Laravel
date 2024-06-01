<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Announcement;

class LatestAnnouncement extends Component
{
    public $latest_announcement;

    public function render()
    {
        $this->latest_announcement = Announcement::latest()->first();

        return view('livewire.Announcements.latest-announcement', [
            'latest_announcement' => $this->latest_announcement
        ]);
    }
}
