<?php

namespace App\Livewire;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListTasks extends Component
{
    public $tasks = [];
    public $today;

    public function render()
    {
        $this->today = Carbon::today();

        $this->tasks = Task::where('user_id', Auth::user()->id)
            ->whereDate('task_date', Carbon::today())
            ->orderBy('time_range_id')
            ->get();

        return view('livewire.list-tasks');
    }
}
