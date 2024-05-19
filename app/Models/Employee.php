<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'employee_number', 'employee_type', 'designation', 'role', 'date_tenure', 'is_active'
    ];

    /**
     * Get the user that has the employee.
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the time records associated with the employee.
     */
    public function time_record() {
        return $this->hasMany('App\Models\TimeRecord');
    }

    /**
     * Get the chat productions associated with the employee.
     */
    public function production_chat() {
        return $this->hasMany('App\Models\ProductionChat');
    }

    /**
     * Get the focal productions associated with the employee.
     */
    public function production_focal() {
        return $this->hasMany('App\Models\ProductionFocal');
    }

    /**
     * Get the plate productions associated with the employee.
     */
    public function production_plate() {
        return $this->hasMany('App\Models\ProductionPlate');
    }

    /**
     * Get the schedules associated with the employee.
     */
    public function schedule() {
        return $this->hasMany('App\Models\Schedule');
    }

    /**
     * Get the tasks associated with the employee.
     */
    public function task() {
        return $this->hasMany('App\Models\Task');
    }
}
