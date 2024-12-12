<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;

class LatestAnnouncements extends Component
{
    public $announcements;

    public function render()
    {
        $this->announcements = Announcement::latest()
            ->limit(10)
            ->get();

        return view('livewire.latest-announcements');
    }
}
