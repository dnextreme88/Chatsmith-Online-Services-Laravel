<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    private $show_number_of_results_choices = [
        5, 10, 15, 20, 25
    ];
    private $employee_type_choices = [
        'OJT', 'Part-time', 'Regular'
    ];
    private $designation_choices = [
        'Baguio', 'Pangasinan'
    ];
    private $role_choices = [
        'Administrator', 'Director', 'Employee', 'Human Resources and Recruitment', 'Owner', 'Quality Analyst', 'Supervisor', 'Team Leader'
    ];

    // The user must be logged in to access the views
    public function __construct() {
        $this->middleware('auth');
    }

    public function index () {
        // Show all employees
        $employees = Employee::paginate(5);
        $user = Auth::user();
        $layout = '';

        if ($user->is_staff == 'True') {
            $layout = 'layouts.admin_panel';
        } elseif ($user->is_staff == 'False') {
            $layout = 'layouts.app';
        }

        return view('employees', [
            'employees' => $employees,
            'user' => $user,
            'layout' => $layout,
            'show_number_of_results_choices' => $this->show_number_of_results_choices,
        ]);
    }

    public function store (Request $request) {
        // Process in adding employee
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|unique:employees',
            'employee_number' => 'required|unique:employees',
            'employee_type' => 'required',
            'designation' => 'required',
            'employee_role' => 'required',
            'date_tenure' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return redirect('employees/create')->withErrors($validator)->withInput();
        }

        Employee::create([
            'user_id' => $request->user_id,
            'employee_number' => $request->employee_number,
            'employee_type' => $request->employee_type,
            'designation' => $request->designation,
            'role' => $request->employee_role,
            'date_tenure' => $request->date_tenure,
        ]);

        return redirect()->back()->withSuccess('Employee successfully added!');
    }

    public function create () {
        // Show add employees form
        $user = Auth::user();
        $employees = Employee::all();

        // Get all users that are not yet registered as employees
        $pending_users = User::doesntHave('employee')->get()->toArray();

        if ($user->is_staff == 'True') {
            return view('add_employee_form', [
                'pending_users' => $pending_users,
                'employee_type_choices' => $this->employee_type_choices,
                'designation_choices' => $this->designation_choices,
                'role_choices' => $this->role_choices
            ]);
        } else {
            abort(403, 'Forbidden page.');
        }
    }

    public function show ($id) {
        // Show specific employee
        $employee = Employee::find($id);
        $user = Auth::user();
        $layout = '';

        if ($user->is_staff == 'True') {
            $layout = 'layouts.admin_panel';
        } elseif ($user->is_staff == 'False') {
            $layout = 'layouts.app';
        }

        return view('show_employee', [
            'employee' => $employee,
            'user' => $user,
            'layout' => $layout,
        ]);

    }

    public function edit ($id) {
        // Show edit employee form
        $employee = Employee::find($id);
        $users = User::all();
        $user = Auth::user();

        if ($user->is_staff == 'True') {
            return view('edit_employee_form', [
                'employee' => $employee,
                'users' => $users,
                'employee_type_choices' => $this->employee_type_choices,
                'designation_choices' => $this->designation_choices,
                'role_choices' => $this->role_choices,
            ]);
        } else {
            abort(403, 'Forbidden page.');
        }
    }

    public function update (Request $request, $id) {
        // Process in updating employee
        $employee = Employee::find($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'unique:employees,id,' .$employee->id,
            'employee_number' => 'unique:employees,employee_number,' .$employee->id,
            'employee_type' => Rule::in(['OJT', 'Part-time', 'Regular']),
            'designation' => Rule::in(['Baguio', 'Pangasinan']),
            'employee_role' => Rule::in(['Administrator', 'Director', 'Employee', 'Human Resources and Recruitment', 'Owner', 'Quality Analyst', 'Supervisor', 'Team Leader']),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee->user_id = $request->user_id;
        $employee->employee_number = $request->employee_number;
        $employee->employee_type = $request->employee_type;
        $employee->designation = $request->designation;
        $employee->role = $request->employee_role;
        $employee->date_tenure = $request->date_tenure;
        $employee->is_active = $request->is_active == 'on' ? 'True' : 'False';
        $employee->save();

        return redirect()->back()->withSuccess('Employee successfully edited!');
    }

    public function destroy ($id) {
        // Delete employee
        $user = Auth::user();

        if ($user->is_staff == 'True') {
            $employee = Employee::find($id);
            $employee->delete();
            // Get URL of certain controller with view method and pass parameters
            $controller_url = action('EmployeeController@show', ['employee' => $id]);
            // Get current URL
            $current_url = url()->current();

            $employees = Employee::paginate(5);
            $user = Auth::user();

            // If admin is deleting an employee from /employee/{id}/, execute this clause
            if ($controller_url == $current_url) {
                return redirect('/employees/')->withSuccess('Employee successfully deleted!')
                    ->with('employees', $employees)
                    ->with('user', $user);
            // If admin is deleting an employee from /employees/, execute this clause
            } else {
                return redirect()->back()->withSuccess('Employee successfully deleted!');
            }
        } else {
            abort(403, 'Forbidden page.');
        }
    }

    public function search_employees (Request $request) {
        $user = Auth::user();
        $layout = '';
        $search_success_message = '';
        $query = $request->search_employees_query;
        $show_number_of_results = $request->show_number_of_results;

        $validator = Validator::make($request->all(), [
            'search_employees_query' => 'required',
            'show_number_of_results' => ['integer', Rule::in([5, 10, 15, 20, 25])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employees = Employee::join('users', 'users.id', 'employees.user_id')->where('users.username', 'like', '%' .$query. '%')->paginate($show_number_of_results);

        // For page?= parameter in URLs
        $employees->withPath('query?search_employees_query=' .$query. '&show_number_of_results=' .$show_number_of_results. '&submit=');

        if ($user->is_staff == 'True') {
            $layout = 'layouts.admin_panel';
        } elseif ($user->is_staff == 'False') {
            $layout = 'layouts.app';
        }

        if ($employees->total() == 1) {
            $search_success_message = 'Your search returned ' .$employees->total(). ' result.';
        } elseif ($employees->total() > 1) {
            $search_success_message = 'Your search returned ' .$employees->total(). ' results.';
        } elseif ($employees->total() == 0) {
            $search_success_message = 'No results were found with the query "' .$query. '".';
        }

        return view('employees', [
            'employees' => $employees,
            'user' => $user,
            'layout' => $layout,
            'search_success_message' => $search_success_message,
            'show_number_of_results_choices' => $this->show_number_of_results_choices,
        ]);
    }
}
