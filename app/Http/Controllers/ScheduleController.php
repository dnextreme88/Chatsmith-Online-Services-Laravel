<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index () {
        $user = Auth::user();
        $layout = '';
        $from = Carbon::today()->format('Y-m-d');
        $to = Carbon::today()->addDays(6)->format('Y-m-d');

        $employees = Employee::join('users', 'users.id', 'employees.user_id')->where('employees.is_active', 'True')->orderBy('users.last_name', 'asc')->get();
        $schedules = Schedule::whereBetween('date_of_shift', [$from, $to])->groupBy('id', 'user_id', 'employee_id', 'time_of_shift', 'date_of_shift', 'created_at', 'updated_at')->orderBy('date_of_shift', 'asc')->distinct()->get();

        if ($user) {
            if ($user->is_staff == 'True') {
                $layout = 'layouts.admin_panel';
            } elseif ($user->is_staff == 'False') {
                $layout = 'layouts.app';
            }
        } else {
            $layout = 'layouts.app';
        }

        return view('schedules', [
            'user' => $user,
            'start_date' => $from,
            'end_date' => $to,
            'employees' => $employees,
            'schedules' => $schedules,
            'layout' => $layout,
        ]);
    }

    public function show_schedule_of_employee ($id) {
        // Show schedules by employee
        $user = Auth::user();
        $find_employee_by_id = Employee::where('id', $id)->first();
        $schedules_of_employee = Schedule::where('employee_id', '=', $find_employee_by_id->id)->orderBy('date_of_shift', 'asc')->paginate(5);
        $layout = '';
        $earliest_date_of_shift = '';
        $latest_date_of_shift = '';

        // If employee has schedules
        if ($find_employee_by_id->schedule->count() > 0) {
            $earliest_date_of_shift = Schedule::where('employee_id', '=', $find_employee_by_id->id)->orderBy('date_of_shift', 'asc')->first()->date_of_shift;
            $latest_date_of_shift = Schedule::where('employee_id', '=', $find_employee_by_id->id)->orderBy('date_of_shift', 'desc')->latest()->first()->date_of_shift;
        }

        if ($user) {
            if ($user->is_staff == 'True') {
                $layout = 'layouts.admin_panel';
            } elseif ($user->is_staff == 'False') {
                $layout = 'layouts.app';
            }
        } else {
            $layout = 'layouts.app';
        }

        return view('show_schedule_by_employee', [
            'user' => $user,
            'employee_by_id' => $find_employee_by_id,
            'schedules' => $schedules_of_employee,
            'start_date' => $earliest_date_of_shift,
            'end_date' => $latest_date_of_shift,
            'layout' => $layout,
        ]);
    }

    public function filter_schedule_of_employee (Request $request, $id) {
        // Filter schedules based on start_date and end_date
        $user = Auth::user();
        $find_employee_by_id = Employee::where('id', $id)->first();
        $layout = '';
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // If end_date is less than start_date
        if ($end_date < $start_date) {
            $errors = ['end_date_less_than_start_date' => 'End date should not be less than start date.'];

            return redirect()->back()->withErrors($errors);
        }

        $schedules_of_employee = Schedule::where('employee_id', '=', $find_employee_by_id->id)->whereBetween('date_of_shift', [$start_date, $end_date])->orderBy('date_of_shift', 'asc')->paginate(5);

        if ($user) {
            if ($user->is_staff == 'True') {
                $layout = 'layouts.admin_panel';
            } elseif ($user->is_staff == 'False') {
                $layout = 'layouts.app';
            }
        } else {
            $layout = 'layouts.app';
        }

        return view('show_schedule_by_employee', [
            'user' => $user,
            'employee_by_id' => $find_employee_by_id,
            'schedules' => $schedules_of_employee,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'layout' => $layout,
        ]);
    }

    public function view_schedule_by_week (Request $request) {
        // view schedule by week
        $user = Auth::user();
        $layout = '';
        $start_of_week = $request->start_of_week;
        $end_of_week = Carbon::parse($start_of_week)->addDays(6)->format('Y-m-d');

        $employees = Employee::join('users', 'users.id', 'employees.user_id')->where('employees.is_active', 'True')->orderBy('users.last_name', 'asc')->paginate(6);
        $schedules = Schedule::whereBetween('date_of_shift', [$start_of_week, $end_of_week])->groupBy('id', 'user_id', 'employee_id', 'time_of_shift', 'date_of_shift', 'created_at', 'updated_at')->orderBy('date_of_shift', 'asc')->distinct()->get();

        if ($user) {
            if ($user->is_staff == 'True') {
                $layout = 'layouts.admin_panel';
            } elseif ($user->is_staff == 'False') {
                $layout = 'layouts.app';
            }
        } else {
            $layout = 'layouts.app';
        }

        return view('schedules', [
            'user' => $user,
            'start_date' => $start_of_week,
            'end_date' => $end_of_week,
            'employees' => $employees,
            'schedules' => $schedules,
            'layout' => $layout,
        ]);
    }
}
