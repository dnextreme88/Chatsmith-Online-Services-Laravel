<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionFocal extends Model
{
    use HasFactory;

    // Overrides Laravel's naming convention of tables and specifies a custom one.
    protected $table = 'production_focal';

    protected $fillable = [
        'user_id', 'employee_id', 'time_range_id', 'account_used', 'minutes_worked', 'oos_count', 'not_oos_count', 'discard_count', 'total_count'
    ];

    /**
     * Get the employee associated with the focal production.
     */
    public function employee() {
        return $this->belongsTo('App\Models\Employee');
    }

    /**
     * Get the time ranges associated with the focal production.
     */
    public function time_range() {
        return $this->belongsTo('App\Models\TimeRange');
    }
}
