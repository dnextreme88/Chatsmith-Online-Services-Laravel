<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;

class ListAnnouncements extends Component
{
    public function render()
    {
        $announcements = Announcement::paginate(5);

        return view('livewire.list-announcements', compact('announcements'));
    }
}
