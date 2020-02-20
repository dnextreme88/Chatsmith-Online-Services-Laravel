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
		$test_1 = ProductionChat::find(1)->created_at->format('Y-m-d');
		$daily_productions_chat_accounts = ProductionChat::where('created_at', 'like', $date_today->format('Y-m-d') . '%')->orderBy('minutes_worked','desc')->get();
		$daily_productions_focal = ProductionFocal::where('created_at', 'like', $date_today->format('Y-m-d') . '%')->orderBy('minutes_worked','desc')->get();
		$daily_productions_plate = ProductionPlate::where('created_at', 'like', $date_today->format('Y-m-d') . '%')->orderBy('minutes_worked','desc')->get();

		return view('daily_productions', [
			'date_today' => $date_today,
			'daily_productions_chat_accounts' => $daily_productions_chat_accounts,
			'daily_productions_focal' => $daily_productions_focal,
			'daily_productions_plate' => $daily_productions_plate,
		]);
	}
}
