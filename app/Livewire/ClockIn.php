<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\TimeRecord;
use Carbon\Carbon;

class ClockIn extends Component
{
    public $time_of_shift;

    public function render()
    {
        return view('livewire.dashboard.clock-in');
    }

    public function create_time_record()
    {
        $user = Auth::user();

        $employee_has_current_timein = TimeRecord::where('user_id', $user->id)
            ->whereColumn('timestamp_in', 'timestamp_out')
            ->exists();

        if ($employee_has_current_timein) {
            $this->dispatch('clock-in-fail', name: $user->first_name);
        } else {
            TimeRecord::create([
                'user_id' => $user->id,
                'employee_id' => $user->employee->id,
                'time_of_shift' => $this->time_of_shift ? $this->time_of_shift : '6AM-5PM',
                'date_of_shift' => Carbon::today(),
                'employee_name' => $user->first_name. $user->maiden_name. $user->last_name,
                'timestamp_in' => Carbon::now(),
                'timestamp_out' => Carbon::now()
            ]);

            $this->dispatch('clock-in-success', [
                'time_of_shift' => $this->time_of_shift,
                'timestamp_in' => Carbon::now()
            ]);
        }
    }
}
