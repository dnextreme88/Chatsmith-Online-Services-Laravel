<?php

namespace App\Livewire;

use App\Filament\Resources\ScheduleResource;
use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListSchedules extends Component
{
    public $create_schedule_url;
    public $user;
    public $start_date;
    public $end_date;
    public $dates_after_start_date = [];
    public $employees;
    public $schedules;

    public function render()
    {
        $this->create_schedule_url = ScheduleResource::getUrl('create');
        $this->user = Auth::user();
        $this->start_date = Carbon::today()
            ->format('F j');
        $this->end_date = Carbon::today()
            ->addDays(6)
            ->format('F j, Y');

        for ($i = 0; $i < 7; $i++) {
            array_push($this->dates_after_start_date, [
                'date' => Carbon::parse($this->start_date)->addDays($i)->format('M j'), // eg. August 28
                'day' => Carbon::parse($this->start_date)->addDays($i)->format('D') // eg. Wed
            ]);
        }

        $this->employees = Employee::join('users', 'users.id', 'employees.user_id')
            ->where('employees.is_active', 'True')
            ->orderBy('users.last_name', 'ASC')
            ->get();
        $this->schedules = Schedule::whereBetween('date_of_shift', [$this->start_date, $this->end_date])
            ->groupBy('id', 'user_id', 'employee_id', 'time_of_shift', 'date_of_shift', 'created_at', 'updated_at')
            ->orderBy('date_of_shift', 'ASC')
            ->distinct()
            ->get();

        return view('livewire.filament.admin.list-schedules');
    }
}
