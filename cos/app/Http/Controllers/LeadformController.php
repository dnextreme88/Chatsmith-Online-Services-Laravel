<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\ProductionChat;
use App\ProductionFocal;
use App\ProductionPlate;
use App\Employee;
use App\TimeRange;

class LeadformController extends Controller
{
	private $chat_account_tool_choices = [
		'Live Chat', 'PersistIQ', 'Smart Alto'
	];

	private $plateiq_tool_choices = [
		'Full Form', 'Needs Manager Review (NMR)', 'New Data Entry (NDE)', 'Pending Header', 'Statements', 'Verification'
	];

	// The user must be logged in to access the views
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function store_chat_account_leadform (Request $request) {
		// process in adding chat account production
		$user = Auth::user();

		$validator = Validator::make($request->all() , 
		[
			'employee_id' => 'required',
			'minutes_worked' => ['required', 'max:60', 'min:1'],
		]);

		if ($validator->fails()) {
			return redirect("leadforms/chat_account")->withErrors($validator)->withInput();
		}

		ProductionChat::create([
			'user_id' => $user->id,
			'employee_id' => $request->employee_id,
			'time_range_id' => $request->time_range_id,
			'account_used' => $request->account_used,
			'minutes_worked' => $request->minutes_worked,
			'chat_account_tool' => $request->chat_account_tool,
		]);

		return redirect()->back()->withSuccess('Leadform for Chat Account successfully submitted!');
	}

	public function store_focal_leadform (Request $request) {
		// process in adding focal production
		$user = Auth::user();

		$validator = Validator::make($request->all() , 
		[
			'employee_id' => 'required',
			'minutes_worked' => ['required', 'max:60', 'min:1'],
		]);

		if ($validator->fails()) {
			return redirect("leadforms/focal")->withErrors($validator)->withInput();
		}

		// Check if inputs are null
		if (($request->oos_count == '') or ($request->oos_count == ' ')) {
			$request->oos_count = 0;
		}

		if (($request->not_oos_count == '') or ($request->not_oos_count == ' ')) {
			$request->not_oos_count = 0;
		}

		if (($request->discard_count == '') or ($request->discard_count == ' ')) {
			$request->discard_count = 0;
		}

		$total_count = $request->oos_count + $request->not_oos_count + $request->discard_count;

		ProductionFocal::create([
			'user_id' => $user->id,
			'employee_id' => $request->employee_id,
			'time_range_id' => $request->time_range_id,
			'account_used' => $request->account_used,
			'minutes_worked' => $request->minutes_worked,
			'oos_count' => $request->oos_count,
			'not_oos_count' => $request->not_oos_count,
			'discard_count' => $request->discard_count,
			'total_count' => $total_count,
		]);

		return redirect()->back()->withSuccess('Leadform for Focal successfully submitted!');
	}

	public function store_plateiq_leadform (Request $request) {
		// process in adding plate production
		$user = Auth::user();

		$validator = Validator::make($request->all() , 
		[
			'employee_id' => 'required',
			'minutes_worked' => ['required', 'max:60', 'min:1'],
		]);

		if ($validator->fails()) {
			return redirect("leadforms/plateiq")->withErrors($validator)->withInput();
		}

		// Check if inputs are null
		if (($request->no_of_edits == '') or ($request->no_of_edits == ' ')) {
			$request->no_of_edits = 0;
		}

		if (($request->no_of_invoices_completed == '') or ($request->no_of_invoices_completed == ' ')) {
			$request->no_of_invoices_completed = 0;
		}

		if (($request->no_of_invoices_sent_to_manager == '') or ($request->no_of_invoices_sent_to_manager == ' ')) {
			$request->no_of_invoices_sent_to_manager = 0;
		}

		$total_count = $request->no_of_invoices_completed + $request->no_of_invoices_sent_to_manager;

		ProductionPlate::create([
			'user_id' => $user->id,
			'employee_id' => $request->employee_id,
			'time_range_id' => $request->time_range_id,
			'account_used' => $request->account_used,
			'minutes_worked' => $request->minutes_worked,
			'plateiq_tool' => $request->plateiq_tool,
			'no_of_edits' => $request->no_of_edits,
			'no_of_invoices_completed' => $request->no_of_invoices_completed,
			'no_of_invoices_sent_to_manager' => $request->no_of_invoices_sent_to_manager,
			'total_count' => $total_count,
		]);

		return redirect()->back()->withSuccess('Leadform for Plate IQ successfully submitted!');
	}

	public function create_chat_account_leadform () {
		$user = Auth::user();
		$employees = Employee::all();
		$time_ranges = TimeRange::all();

		return view('leadform_chat_account', [
			"user" => $user,
			"employees" => $employees,
			"time_ranges" => $time_ranges,
			"chat_account_tool_choices" => $this->chat_account_tool_choices,
		]);
	}

	public function create_focal_leadform () {
		$user = Auth::user();
		$employees = Employee::all();
		$time_ranges = TimeRange::all();

		return view('leadform_focal', [
			"user" => $user,
			"employees" => $employees,
			"time_ranges" => $time_ranges,
		]);
	}

	public function create_plateiq_leadform () {
		$user = Auth::user();
		$employees = Employee::all();
		$time_ranges = TimeRange::all();

		return view('leadform_plateiq', [
			"user" => $user,
			"employees" => $employees,
			"time_ranges" => $time_ranges,
			"plateiq_tool_choices" => $this->plateiq_tool_choices,
		]);
	}
}
