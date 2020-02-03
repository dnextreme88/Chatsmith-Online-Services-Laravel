<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
	protected $fillable = [
		'user_id', 'title', 'description'
	];

	/**
	 * Get the user associated with the announcement.
	 */
	public function user() {
		return $this->belongsTo('App\User');
	}
}
