<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeRange extends Model
{
    use HasFactory;

    protected $fillable = ['time_range'];

    /**
     * Get the chat production associated with the time range.
     */
    public function production_chat() {
        return $this->belongsTo('App\Models\ProductionChat');
    }

    /**
     * Get the focal production associated with the time range.
     */
    public function production_focal() {
        return $this->belongsTo('App\Models\ProductionFocal');
    }

    /**
     * Get the plate production associated with the time range.
     */
    public function production_plate() {
        return $this->belongsTo('App\Models\ProductionPlate');
    }

    /**
     * Get the task associated with the time range.
     */
    public function task() {
        return $this->belongsTo('App\Models\Task');
    }
}
