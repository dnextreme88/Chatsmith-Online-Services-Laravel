<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'employee_id', 'time_range_id', 'task_name', 'task_date'
    ];

    /**
     * Get the employee associated with the task.
     */
    public function employee() {
        return $this->belongsTo('App\Models\Employee');
    }

    /**
     * Get the time range associated with the task.
     */
    public function time_range() {
        return $this->belongsTo('App\Models\TimeRange');
    }
}
