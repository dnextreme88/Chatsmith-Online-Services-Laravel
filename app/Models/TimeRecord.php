<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
		'user_id', 'employee_id', 'time_of_shift', 'date_of_shift', 'timestamp_in', 'timestamp_out',
	];

	/**
	 * Get the employee associated with the time record.
	 */
	public function employee() {
		return $this->belongsTo('App\Models\Employee');
	}

	/**
	 * Get the user associated with the time record.
	 */
	public function user() {
		return $this->belongsTo('App\Models\User');
	}
}
