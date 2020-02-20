<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionFocal extends Model
{
	//Overrides Laravel's naming convention of tables and specifies a custom one.
	protected $table = 'production_focal';

	protected $fillable = [
		'user_id', 'employee_id', 'account_used', 'time_range', 'minutes_worked', 'oos_count', 'not_oos_count', 'discard_count', 'total_count'
	];

	/**
	 * Get the employee associated with the focal production.
	 */
	public function employee() {
		return $this->belongsTo('App\Employee');
	}
}
