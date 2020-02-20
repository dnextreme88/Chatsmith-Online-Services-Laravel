<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionChat extends Model
{
	//Overrides Laravel's naming convention of tables and specifies a custom one.
	protected $table = 'production_chat';

	protected $fillable = [
		'user_id', 'employee_id', 'account_used', 'time_range', 'minutes_worked', 'chat_account_tool'
	];

	/**
	 * Get the employee associated with the chat production.
	 */
	public function employee() {
		return $this->belongsTo('App\Employee');
	}
}
