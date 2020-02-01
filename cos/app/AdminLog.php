<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
	protected $fillable = [
		'description'
	];

    /**
     * Get the user associated with the log.
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
