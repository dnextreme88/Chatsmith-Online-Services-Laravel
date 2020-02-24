<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeRange extends Model
{
	protected $fillable = ['time_range'];

	/**
	 * Get the chat production associated with the time range.
	 */
	public function production_chat () {
		return $this->belongsTo('App\ProductionChat');
	}

	/**
	 * Get the focal production associated with the time range.
	 */
	public function production_focal () {
		return $this->belongsTo('App\ProductionFocal');
	}

	/**
	 * Get the plate production associated with the time range.
	 */
	public function production_plate () {
		return $this->belongsTo('App\ProductionPlate');
	}
}
