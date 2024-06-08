<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\TimeRecord;

class Dashboard extends Component
{
    #[On('clock-in-success')]
    public function render()
    {
        // Show dashboard of auth user
        $user = Auth::user();

        $employee_time_records = TimeRecord::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);

        if (!$user->employee) {
            $is_active_employee = false;
        } else {
            $employee = Employee::where([
                'id' => $user->employee->id,
                'is_active' => 'True',
            ])->exists();

            $is_active_employee = $employee ? true : false;
        }

        return view('livewire.dashboard', [
            'user' => $user,
            'time_records' => $employee_time_records,
            'is_active_employee' => $is_active_employee,
        ]);
    }

    #[On('clock-out-success')]
    public function update_timestamps_table()
    {
        //
    }
}
