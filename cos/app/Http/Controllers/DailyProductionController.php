<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\ProductionChat;
use App\ProductionFocal;
use App\ProductionPlate;

class DailyProductionController extends Controller
{
	public function index() {
		// Show daily productions for Chat Accounts, Focal and Plate
		$date_today = Carbon::today(); // eg. 2020-02-14
		$daily_productions_chat_accounts = ProductionChat::join('employees', 'employees.id', 'production_chat.employee_id')->join('users', 'users.id', 'production_chat.user_id')->where('production_chat.created_at', 'like', $date_today->format('Y-m-d') . '%')->orderBy('production_chat.time_range_id', 'asc')->orderBy('users.first_name', 'asc')->get();
		$daily_productions_focal = ProductionFocal::join('employees', 'employees.id', 'production_focal.employee_id')->join('users', 'users.id', 'production_focal.user_id')->where('production_focal.created_at', 'like', $date_today->format('Y-m-d') . '%')->orderBy('production_focal.time_range_id', 'asc')->orderBy('users.first_name', 'asc')->get();
		$daily_productions_plate = ProductionPlate::join('employees', 'employees.id', 'production_plate.employee_id')->join('users', 'users.id', 'production_plate.user_id')->where('production_plate.created_at', 'like', $date_today->format('Y-m-d') . '%')->orderBy('production_plate.time_range_id', 'asc')->orderBy('users.first_name', 'asc')->get();

		return view('daily_productions', [
			'date_today' => $date_today,
			'daily_productions_chat_accounts' => $daily_productions_chat_accounts,
			'daily_productions_focal' => $daily_productions_focal,
			'daily_productions_plate' => $daily_productions_plate,
		]);
	}
}
