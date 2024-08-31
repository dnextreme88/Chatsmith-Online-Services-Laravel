<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'employee_id', 'time_of_shift', 'date_of_shift'
    ];

    /**
     * Get the employee associated with the schedule.
     */
    public function employee() {
        return $this->belongsTo('App\Models\Employee');
    }

    /**
     * Get the user associated with the schedule.
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
