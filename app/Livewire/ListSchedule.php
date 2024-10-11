<?php

namespace App\Livewire;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListSchedule extends Component
{
    public $employee_schedules = [];
    public $events_to_add = [];

    public function render()
    {
        $today = Carbon::now();

        $this->employee_schedules = Schedule::select(['time_of_shift', 'date_of_shift'])
            ->whereBetween('date_of_shift', [$today->copy()->subMonth()->startOfMonth()->format('Y-m-d'), $today->copy()->addMonth()->endOfMonth()->format('Y-m-d')])
            ->where('user_id', Auth::user()->id)
            ->get();

        foreach ($this->employee_schedules as $schedule) {
            array_push($this->events_to_add, [
                'title' => $schedule['time_of_shift'],
                'start' => $schedule['date_of_shift']
            ]);
        }

        $this->events_to_add = json_encode($this->events_to_add); // Will be parsed as JSON when passed into fullcalendar.js

        return view('livewire.list-schedule');
    }
}
