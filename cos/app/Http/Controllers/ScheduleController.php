<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\User;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    private $time_of_shift_choices = [
        '6:00 AM - 5:00 PM', '8:00 AM - 7:00 PM', '7:00 PM - 6:00 AM', '9:00 PM - 8:00 AM'
    ];

    public function index () {
        $user = Auth::user();
        $layout = '';
        $from = date('2020-03-17');
        $to = date('2020-03-23');

        $employees = Employee::join('users', 'users.id', 'employees.user_id')->where('employees.is_active', 'True')->orderBy('users.last_name', 'asc')->paginate(6);
        $schedules = Schedule::whereBetween('date_of_shift', [$from, $to])->groupBy('date_of_shift', 'employee_id')->orderBy('date_of_shift', 'asc')->distinct()->get();

        $day1 = Carbon::today()->format('F j, Y');
        $day1_day = Carbon::today()->format('D');

        $day2 = Carbon::today()->addDays(1)->format('F j, Y');
        $day2_day = Carbon::today()->addDays(1)->format('D');

        $day3 = Carbon::today()->addDays(2)->format('F j, Y');
        $day3_day = Carbon::today()->addDays(2)->format('D');

        $day4 = Carbon::today()->addDays(3)->format('F j, Y');
        $day4_day = Carbon::today()->addDays(3)->format('D');

        $day5 = Carbon::today()->addDays(4)->format('F j, Y');
        $day5_day = Carbon::today()->addDays(4)->format('D');

        $day6 = Carbon::today()->addDays(5)->format('F j, Y');
        $day6_day = Carbon::today()->addDays(5)->format('D');

        $day7 = Carbon::today()->addDays(6)->format('F j, Y');
        $day7_day = Carbon::today()->addDays(6)->format('D');

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
            'day1' => $day1,
            'day1_day' => $day1_day,
            'day2' => $day2,
            'day2_day' => $day2_day,
            'day3' => $day3,
            'day3_day' => $day3_day,
            'day4' => $day4,
            'day4_day' => $day4_day,
            'day5' => $day5,
            'day5_day' => $day5_day,
            'day6' => $day6,
            'day6_day' => $day6_day,
            'day7' => $day7,
            'day7_day' => $day7_day,
            'user' => $user,
            'start_date' => $from,
            'end_date' => $to,
            'employees' => $employees,
            'schedules' => $schedules,
            'layout' => $layout,
        ]);


//        $user = Auth::user();
//        $layout = '';
//        $start_date = Carbon::today();
//        $end_date = Carbon::today()->addDays(7);
//
//        if ($user) {
//            if ($user->is_staff == 'True') {
//                $layout = 'layouts.admin_panel';
//            } elseif ($user->is_staff == 'False') {
//                $layout = 'layouts.app';
//            }
//        } else {
//            $layout = 'layouts.app';
//        }
//
//        return view('schedules', [
//            'schedules' => $schedules,
//            'employees' => $employees,
//            'user' => $user,
//            'layout' => $layout,
//            'start_date' => $start_date,
//            'end_date' => $end_date,
//        ]);
    }

    public function store (Request $request) {
        // process in adding schedule
        $validator = Validator::make($request->all() ,
            [
                'time_of_shift' => 'required',
                'date_of_shift' => 'required',
            ]);

        if ($validator->fails()) {
            return redirect("schedules/create")->withErrors($validator)->withInput();
        }

        $employee = User::find($request->user_id)->employee;

        Schedule::create([
            'user_id' => $request->user_id,
            'employee_id' => $employee->id,
            'time_of_shift' => $request->time_of_shift,
            'date_of_shift' => $request->date_of_shift,
        ]);

        return redirect()->back()->withSuccess('Schedule successfully added!');
    }

    public function create () {
        // show add schedules form
        $user = Auth::user();
        $users = User::all();

        if ($user) {
            if ($user->is_staff == 'True') {
                return view('add_schedule_form', [
                    'users' => $users,
                    'time_of_shift_choices' => $this->time_of_shift_choices,
                ]);
            } else {
                abort(403, 'Forbidden page.');
            }
        } else {
            abort(403, 'Forbidden page.');
        }
    }

    public function edit ($id) {
        // show edit schedule form
        $schedule = Schedule::find($id);
        $users = User::all();
        $user = Auth::user();

        if ($user->is_staff == 'True') {
            return view('edit_schedule_form', [
                "schedule" => $schedule,
                "users" => $users,
                "time_of_shift_choices" => $this->time_of_shift_choices,
            ]);
        } else {
            abort(403, 'Forbidden page.');
        }
    }

    public function update (Request $request, $id) {
        // process in updating schedule
        $schedule = Schedule::find($id);

        $validator = Validator::make($request->all() ,
            [
                'user_id' => 'unique:schedules,id,' .$schedule->id,
                'time_of_shift' => Rule::in(['6:00 AM - 5:00 PM', '8:00 AM - 7:00 PM', '7:00 PM - 6:00 AM', '9:00 PM - 8:00 AM']),
                'date_of_shift' => 'unique:schedules',
            ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee = User::find($request->user_id)->employee;

        $schedule->user_id = $request->user_id;
        $schedule->employee_id = $employee->id;
        $schedule->time_of_shift = $request->time_of_shift;
        $schedule->date_of_shift = $request->date_of_shift;
        $schedule->save();

        return redirect()->back()->withSuccess('Schedule successfully edited!');
    }

    public function destroy ($employee_id, $schedule_id) {
        // delete schedule
        $user = Auth::user();
        $find_employee_by_id = Employee::where('id', $employee_id)->first();
        $layout = 'layouts.admin_panel';

        if ($user->is_staff == 'True') {
            $schedule = Schedule::find($schedule_id);
            $schedule->delete();
            $schedules = Schedule::where('employee_id', '=', $employee_id)->orderBy('date_of_shift', 'asc')->paginate(5);

            return redirect('/schedules/employees/' .$employee_id)->withSuccess('Schedule successfully deleted!')
                ->with("user", $user)
                ->with("employee_id", $find_employee_by_id)
                ->with("schedules", $schedules)
                ->with("layout", $layout);
        } else {
            abort(403, 'Forbidden page.');
        }
    }

    public function show_schedule_by_employee ($id) {
        // show schedules by employee
        $user = Auth::user();
        $find_employee_by_id = Employee::where('id', $id)->first();
        $schedules_of_employee = Schedule::where('employee_id', '=', $find_employee_by_id->id)->orderBy('date_of_shift', 'asc')->paginate(5);
        $layout = '';

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
            "user" => $user,
            "employee_by_id" => $find_employee_by_id,
            "schedules" => $schedules_of_employee,
            "layout" => $layout,
        ]);
    }
}
