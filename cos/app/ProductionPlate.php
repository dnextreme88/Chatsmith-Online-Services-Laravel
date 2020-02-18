<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionPlate extends Model
{
	//Overrides Laravel's naming convention of tables and specifies a custom one.
	protected $table = 'production_plate';

	protected $fillable = [
		'user_id', 'employee_id', 'account_used', 'time_range', 'minutes_worked', 'plateiq_tool', 'no_of_edits', 'no_of_invoices_completed', 'no_of_invoices_sent_to_manager', 'total_count'
	];
}
