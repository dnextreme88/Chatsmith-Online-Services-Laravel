<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Employee;
use App\User;
use Validator;

class EmployeeController extends Controller
{
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

		return view('add_employee_form')->with("users", $users);
	}

    public function show ($id) {
    	// show specific employee
    	$employee = Employee::find($id);

    	return view('show_employee')->with("employee", $employee);
    }
}
