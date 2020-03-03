<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Employee;
use App\User;
use Validator;

class EmployeeController extends Controller
{
	private $employee_type_choices = [
		'OJT', 'Part-time', 'Regular'
	];

	private $designation_choices = [
		'Baguio', 'Pangasinan'
	];

	private $role_choices = [
		'Administrator', 'Director', 'Employee', 'Human Resources and Recruitment', 'Owner', 'Quality Analyst', 'Supervisor', 'Team Leader'
	];
	private $is_active_choices = [
		'True', 'False'
	];

	// The user must be logged in to access the views
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index () {
		// show all employees.
		$employees = Employee::paginate(5);
		$user = Auth::user();

		return view('employees', [
			"employees" => $employees,
			"user" => $user
		]);
	}

	public function store (Request $request) {
		// process in adding employee
		$validator = Validator::make($request->all() , 
		[
			'user_id' => 'required|unique:employees',
			'employee_number' => 'required|unique:employees',
			'employee_type' => 'required',
			'designation' => 'required',
			'employee_role' => 'required',
			'date_tenure' => 'required',
		]);

		if ($validator->fails()) {
			return redirect("employees/create")->withErrors($validator)->withInput();
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
		// show add employees form
		$users = User::all();
		$user = Auth::user();

		if ($user->is_staff == 'True') {
			return view('add_employee_form', [
				"users" => $users,
				"employee_type_choices" => $this->employee_type_choices,
				"designation_choices" => $this->designation_choices,
				"role_choices" => $this->role_choices
			]);
		} else {
			abort(403, 'Forbidden page.');
		}
	}

	public function show ($id) {
		// show specific employee
		$employee = Employee::find($id);
		$user = Auth::user();

		return view('show_employee', [
			"employee" => $employee,
			"user" => $user,
		]);
	}

	public function edit ($id) {
		// show edit employee form
		$employee = Employee::find($id);
		$users = User::all();
		$user = Auth::user();

		if ($user->is_staff == 'True') {
			return view('edit_employee_form', [
				"employee" => $employee,
				"users" => $users,
				"employee_type_choices" => $this->employee_type_choices,
				"designation_choices" => $this->designation_choices,
				"role_choices" => $this->role_choices,
				"is_active_choices" => $this->is_active_choices
			]);
		} else {
			abort(403, 'Forbidden page.');
		}
	}

	public function update (Request $request, $id) {
		// process in updating employee
		$employee = Employee::find($id);

		$validator = Validator::make($request->all() , 
		[
			'user_id' => 'unique:employees,id,' .$employee->id,
			'employee_number' => 'unique:employees,employee_number,' .$employee->id,
			'employee_type' => Rule::in(['OJT', 'Part-time', 'Regular']),
			'designation' => Rule::in(['Baguio', 'Pangasinan']),
			'employee_role' => Rule::in(['Administrator', 'Director', 'Employee', 'Human Resources and Recruitment', 'Owner', 'Quality Analyst', 'Supervisor', 'Team Leader']),
			'is_active' => Rule::in(['True', 'False']),
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
		$employee->is_active = $request->is_active;
		$employee->save();

		return redirect()->back()->withSuccess('Employee successfully edited!');
	}

	public function destroy ($id) {
		// delete employee
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
					->with("employees", $employees)
					->with("user", $user);
			// If admin is deleting an employee from /employees/, execute this clause
			} else {
				return redirect()->back()->withSuccess('Employee successfully deleted!');
			}
		} else {
			abort(403, 'Forbidden page.');
		}
	}
}
