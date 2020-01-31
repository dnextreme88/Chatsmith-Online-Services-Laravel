<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	protected $fillable = [
		'user_id', 'employee_number', 'first_name', 'maiden_name', 'last_name', 'role'
	];
}
