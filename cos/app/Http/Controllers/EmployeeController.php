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
							// 	<option value="Administrator">Administrator</option>
							// <option value="Director">Director</option>
							// <option value="Employee">Employee</option>
							// <option value="Human Resources and Recruitment">Human Resources and Recruitment</option>
							// <option value="Owner">Owner</option>
							// <option value="Quality Analyst">Quality Analyst</option>
							// <option value="Supervisor">Supervisor</option>
							// <option value="Team Leader">Team Leader</option>
	private $role_choices = [
		'Administrator', 'Director', 'Employee', 'Human Resources and Recruitment', 'Owner', 'Quality Analyst', 'Supervisor', 'Team Leader'
	];
	private $is_active_choices = [
		'True', 'False'
	];

	public function index () {
		// show all employees.
		$employees = Employee::paginate(5);
		$user = Auth::user();

		return view('employees')
		->with("employees", $employees)
		->with("user", $user);
	}

	public function store (Request $request) {
		// process in adding employee
		$validator = Validator::make($request->all() , 
		[
			'user_id' => 'required|unique:employees',
			'employee_number' => 'required|unique:employees',
			'first_name' => 'required',
			'employee_role' => 'required',
		]);

		if ($validator->fails()) {
			return redirect("employees/create")->withErrors($validator)->withInput();
		}

		Employee::create([
			'user_id' => $request->user_id,
			'employee_number' => $request->employee_number,
			'first_name' => $request->first_name,
			'maiden_name' => $request->maiden_name,
			'last_name' => $request->last_name,
			'role' => $request->employee_role,
		]);

		return redirect()->back()->withSuccess('Employee successfully added!');
	}

	public function create () {
		// show add employees form
		$users = User::all();

		return view('add_employee_form')
		->with("users", $users)
		->with("role_choices", $this->role_choices);
	}

	public function show ($id) {
		// show specific employee
		$employee = Employee::find($id);

		return view('show_employee')->with("employee", $employee);
	}

	public function edit ($id) {
		// show edit employee form
		$employee = Employee::find($id);
		$users = User::all();

		return view('edit_employee_form')
		->with("employee", $employee)
		->with("users", $users)
		->with("role_choices", $this->role_choices)
		->with("is_active_choices", $this->is_active_choices);
	}

	public function update (Request $request, $id) {
		// process in updating employee
		$employee = Employee::find($id);

		$validator = Validator::make($request->all() , 
		[
			'user_id' => 'unique:users,id,' .$employee->id,
			'employee_number' => 'unique:employees,employee_number,' .$employee->id,
			'employee_role' => Rule::in(['Administrator', 'Director', 'Employee', 'Human Resources and Recruitment', 'Owner', 'Quality Analyst', 'Supervisor', 'Team Leader']),
			'is_active' => Rule::in(['True', 'False']),
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$employee->user_id = $request->user_id;
		$employee->employee_number = $request->employee_number;
		$employee->first_name = $request->first_name;
		$employee->maiden_name = $request->maiden_name;
		$employee->last_name = $request->last_name;
		$employee->role = $request->employee_role;
		$employee->is_active = $request->is_active;
		$employee->save();

		return redirect()->back()->withSuccess('Employee successfully edited!');
	}

	public function destroy ($id) {
		// delete employee

		$employee = Employee::find($id);
		$employee->delete();

		return redirect()->back()->withSuccess('Employee successfully deleted!');
	}
}
