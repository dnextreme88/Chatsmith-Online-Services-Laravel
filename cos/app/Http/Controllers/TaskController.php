<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Task;
use App\TimeRange;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class TaskController extends Controller
{
    private $task_name_choices = [
        'Focal', 'Persist', 'Plate', 'Smart Alto', 'Meeting', 'Training'
    ];

    public function index () {
        $user = Auth::user();
        $time_ranges = TimeRange::all();
        $layout = '';
        $from = Carbon::today()->format('Y-m-d');

        $employees = Employee::join('users', 'users.id', 'employees.user_id')->where('employees.is_active', 'True')->orderBy('users.last_name', 'asc')->get();
        $tasks = Task::where('task_date', '=', $from)->distinct()->get();

        if ($user) {
            if ($user->is_staff == 'True') {
                $layout = 'layouts.admin_panel';
            } elseif ($user->is_staff == 'False') {
                $layout = 'layouts.app';
            }
        } else {
            $layout = 'layouts.app';
        }

        return view('tasks', [
            'user' => $user,
            'start_date' => $from,
            'time_ranges' => $time_ranges,
            'employees' => $employees,
            'tasks' => $tasks,
            'layout' => $layout,
        ]);
    }

    public function store (Request $request) {
        // process in adding task
        $employee = User::find($request->user_id)->employee;
        $task_date = $request->task_date;
        $time_range = $request->time_range;
        $find_time_range = TimeRange::find($time_range);

        foreach ($employee->task as $task) {
            if ($task->time_range_id == $time_range && $task->task_date == $task_date) {
                $errors = array('existing_task_for_time_range' => 'This employee already has a task at ' . $find_time_range->time_range . ' for ' . Carbon::parse($task_date)->format('F j, Y') . '.');
                return redirect()->back()->withErrors($errors);
            }
        }

        Task::create([
            'user_id' => $request->user_id,
            'employee_id' => $employee->id,
            'time_range_id' => $time_range,
            'task_name' => $request->task_name,
            'task_date' => $task_date,
        ]);

        return redirect()->back()->withSuccess('Task successfully added!');
    }

    public function create () {
        // show add tasks form
        $user = Auth::user();
        $users = User::all();
        $time_ranges = TimeRange::all();

        if ($user) {
            if ($user->is_staff == 'True') {
                return view('add_task_form', [
                    'users' => $users,
                    'time_ranges' => $time_ranges,
                    'task_name_choices' => $this->task_name_choices,
                ]);
            } else {
                abort(403, 'Forbidden page.');
            }
        } else {
            abort(403, 'Forbidden page.');
        }
    }

    public function view_task_by_day (Request $request) {
        $user = Auth::user();
        $time_ranges = TimeRange::all();
        $layout = '';
        $daily_task_date = $request->daily_task_date;

        $employees = Employee::join('users', 'users.id', 'employees.user_id')->where('employees.is_active', 'True')->orderBy('users.last_name', 'asc')->get();
        $tasks = Task::where('task_date', '=', $daily_task_date)->distinct()->get();

        if ($user) {
            if ($user->is_staff == 'True') {
                $layout = 'layouts.admin_panel';
            } elseif ($user->is_staff == 'False') {
                $layout = 'layouts.app';
            }
        } else {
            $layout = 'layouts.app';
        }

        return view('tasks', [
            'user' => $user,
            'start_date' => $daily_task_date,
            'time_ranges' => $time_ranges,
            'employees' => $employees,
            'tasks' => $tasks,
            'layout' => $layout,
        ]);
    }
}
