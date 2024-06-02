<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TimeRecord;
use Carbon\Carbon;

class ClockOut extends Component
{
    public $timerecord_id;

    public $is_clocked_out;

    public function render()
    {
        $this->is_clocked_out = false;

        return view('livewire.dashboard.clock-out', [
            'is_clocked_out' => $this->is_clocked_out
        ]);
    }

    public function update_time_record()
    {
        // Process in updating time record
        $time_record = TimeRecord::find($this->timerecord_id);
        $time_record->timestamp_out = Carbon::now();
        $time_record->save();

        $this->dispatch('clock-out-success')->to(Dashboard::class);
    }
}
