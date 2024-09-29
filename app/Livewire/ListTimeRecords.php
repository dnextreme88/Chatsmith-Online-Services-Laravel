<?php

namespace App\Livewire;

use App\Models\TimeRecord;
use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListTimeRecords extends Component
{
    public $timerecord_id_for_clocking_out;
    public $clock_in_modal = false;
    public $clock_out_modal = false;

    public $time_of_shift;
    public $time_of_shifts = [
        '6:00 AM - 5:00 PM',
        '8:00 AM - 7:00 PM',
        '7:00 PM - 6:00 AM',
        '9:00 PM - 8:00 AM'
    ];

    public function create_time_record() // Clock in
    {
        $user = Auth::user();

        $this->validate(['time_of_shift' => [
            'required',
            function (string $attribute, mixed $value, Closure $fail) {
                $employee_has_current_timein = TimeRecord::where('user_id', Auth::user()->id)
                    ->whereColumn('timestamp_in', 'timestamp_out')
                    ->exists();

                if ($employee_has_current_timein) {
                    $fail('You are already clocked in. Please clock out your previous time in.');
                }
            }
        ]]);

        TimeRecord::create([
            'user_id' => $user->id,
            'employee_id' => $user->employee->id,
            'time_of_shift' => $this->time_of_shift,
            'date_of_shift' => Carbon::today(),
            'timestamp_in' => Carbon::now(),
            'timestamp_out' => Carbon::now()
        ]);

        $this->reset();

        $this->clock_in_modal = false;

        $this->dispatch('clock-in-success', [
            'time_of_shift' => $this->time_of_shift,
            'timestamp_in' => Carbon::now()
        ]);
    }

    public function update_time_record($timerecord_id) // Clock out
    {
        $time_record = TimeRecord::find($timerecord_id);
        $time_record->timestamp_out = Carbon::now();
        $time_record->save();

        $this->clock_out_modal = false;

        $this->dispatch('clock-out-success');
    }

    #[On('clock-in-success')]
    #[On('clock-out-success')]
    public function render()
    {
        $time_records = TimeRecord::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('livewire.list-time-records-employee', compact('time_records'));
    }
}
