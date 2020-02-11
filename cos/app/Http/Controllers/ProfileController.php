<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Announcement;
use App\TimeRecord;
use App\Employee;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Validator;

class ProfileController extends Controller
{
	// The user must be logged in to access the views
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index() {
		// Show dashboard of auth user
		$user = Auth::user();
		$latest_announcement = Announcement::latest()->first();
		$employee_time_records = TimeRecord::where('user_id', $user->id)->orderBy('id','desc')->paginate(5);

		return view('profile', [
			'user' => $user,
			'latest_announcement' => $latest_announcement,
			'time_records' => $employee_time_records,
		]);
	}

	public function edit ($id) {
		// Show edit user settings form
		$user = User::find($id);

		// Make sure the auth user only edits his settings and not other user's settings
		if (Auth::user() == $user) {
			return view('edit_user_settings_form')->with('user', $user);
		} else {
			abort(403, 'Unauthorized action.');
		}
	}

	public function update (Request $request, $id) {
		// Process in updating user settings
		$user = User::find($id);

		// Validate user input
		$validator = Validator::make($request->all() , 
		[
			'email' => 'unique:users,email,' .$user->id,
			'current_password' => 'required',
			'change_password' => 'same:change_password',
			'change_password_confirm' => 'same:change_password',
		]);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		$user_password = Auth::user()->password;
		// Check if auth user's password is a match to input current password
		if (Hash::check($request->current_password, $user_password)) {
			$user_id = Auth::user()->id;
			$user = User::find($user_id);
			$user->email = $request->email;
				if 	(
					($request->get('change_password') != null and $request->get('change_password_confirm') != null) and 
					($request->has('change_password') == $request->has('change_password_confirm'))
					) {
					$user->password = Hash::make($request->change_password);
				}
			$user->save(); 

			return redirect()->back()->withSuccess('User settings are successfully updated!');

		}
		else {
			$errors = array('current_password' => 'The current password is incorrect.');
			return redirect()->back()->withErrors($errors)->withInput();
		}
	}

	public function create_time_record (Request $request) {
		// Process in adding time record
		$user = Auth::user();
		$employee = $user->employee;

		// If user is not yet an employee, do not create time record
		if (!$employee) {
			$errors = array('not_an_employee' => 'You are not yet an employee. Please contact the administrator.');
			return redirect()->back()->withErrors($errors);
		} else {
			TimeRecord::create([
				'user_id' => $user->id,
				'employee_id' => $user->employee->id,
				'time_of_shift' => $request->time_of_shift,
				'date_of_shift' => Carbon::today(),
				'employee_name' => $user->name,
				'timestamp_in' => Carbon::now(),
				'timestamp_out' => Carbon::now()
			]);

			return redirect()->back()->withSuccess('You have successfully clocked in!');
		}
	}

	public function update_time_record (Request $request, $id) {
		// Process in updating time record
		$time_record = TimeRecord::find($id);
		$time_record->timestamp_out = Carbon::now();
		$time_record->save();

		return redirect()->back()->withSuccess('You have successfully clocked out!');
	}

}
