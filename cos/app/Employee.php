<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $fillable = [
		'user_id', 'employee_number', 'employee_type', 'designation', 'role', 'is_active'
	];

	/**
	 * Get the user that has the employee.
	 */
	public function user() {
		return $this->belongsTo('App\User');
	}

	/**
	 * Get the time records associated with the employee.
	 */
	public function time_record () {
		return $this->hasMany('App\TimeRecord');
	}

	/**
	 * Get the chat productions associated with the employee.
	 */
	public function production_chat () {
		return $this->hasMany('App\ProductionChat');
	}

	/**
	 * Get the focal productions associated with the employee.
	 */
	public function production_focal () {
		return $this->hasMany('App\ProductionFocal');
	}

	/**
	 * Get the plate productions associated with the employee.
	 */
	public function production_plate () {
		return $this->hasMany('App\ProductionPlate');
	}
}
