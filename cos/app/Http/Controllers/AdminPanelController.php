<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AdminLog;

class AdminPanelController extends Controller
{
    public function index () {
    	$user = Auth::user();
    	$admin_logs = AdminLog::paginate(5);;

    	if ($user->is_staff == 'True') {
    		return view('admin_panel')
    		->with('user', $user)
    		->with('admin_logs', $admin_logs);
    	} else {
			abort(404, 'Forbidden page.');
		}
    }
}
