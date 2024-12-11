<?php

namespace App\Livewire;

use App\Models\TimeRecord;
use Livewire\Component;

class LatestTimeRecords extends Component
{
    public $time_records;

    public function render()
    {
        // TODO: IN CASE I DECIDE TO REMOVE/RENAME THE created_at AND updated_at FIELDS,
        // THIS QUERY MUST BE REFACTORED SINCE latest() IS GONNA USE THE created_at FIELD BY DEFAULT
        // FOR ORDERING IT IN DESCENDING ORDER
        $this->time_records = TimeRecord::latest()
            ->limit(10)
            ->get();

        return view('livewire.latest-time-records');
    }
}
