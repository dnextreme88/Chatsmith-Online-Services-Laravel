<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AdminLog;

class AdminPanelController extends Controller
{
	// The user must be logged in to access the views
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index () {
		$user = Auth::user();
		$admin_logs = AdminLog::paginate(5);

		if ($user->is_staff == 'True') {
			return view('admin_panel_home')
				->with('user', $user)
				->with('admin_logs', $admin_logs);
		} else {
			abort(403, 'Forbidden page.');
		}
	}
}
