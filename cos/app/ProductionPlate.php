<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionPlate extends Model
{
	//Overrides Laravel's naming convention of tables and specifies a custom one.
	protected $table = 'production_plate';

	protected $fillable = [
		'user_id', 'employee_id', 'time_range_id', 'account_used', 'minutes_worked', 'plateiq_tool', 'no_of_edits', 'no_of_invoices_completed', 'no_of_invoices_sent_to_manager', 'total_count'
	];

	/**
	 * Get the employee associated with the plate production.
	 */
	public function employee () {
		return $this->belongsTo('App\Employee');
	}

	/**
	 * Get the time ranges associated with the plate production.
	 */
	public function time_range () {
		return $this->belongsTo('App\TimeRange');
	}
}
