<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeRecord extends Model
{
	protected $fillable = [
		'user_id', 'employee_id', 'time_of_shift', 'date_of_shift', 'employee_name', 'timestamp_in', 'timestamp_out',
	];

	/**
	 * Get the employee associated with the time record.
	 */
	public function employee() {
		return $this->belongsTo('App\Employee');
	}

	/**
	 * Get the user associated with the time record.
	 */
	public function user() {
		return $this->belongsTo('App\User');
	}
}
