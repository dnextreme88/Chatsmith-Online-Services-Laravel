<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $fillable = [
		'user_id', 'employee_number', 'first_name', 'maiden_name', 'last_name', 'role', 'is_active'
	];

    /**
     * Get the user that has the employee.
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
