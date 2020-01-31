<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Validator;

class ProfileController extends Controller
{
	public function index() {
		$user = Auth::user();

		return view('profile',
			["user" => $user, 
		]);
	}

	public function edit ($id) {
		// show edit user form
		$user = User::find($id);

		return view('edit_user_form')
			->with("user", $user);
	}

	public function update (Request $request, $id) {
		// process in updating user
		$user = User::find($id);
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

			return redirect('/profile');
		}
		else {
			$errors = array('current_password' => 'The current password is incorrect.');
			return redirect()->back()->withErrors($errors)->withInput();
		}
	}

}
