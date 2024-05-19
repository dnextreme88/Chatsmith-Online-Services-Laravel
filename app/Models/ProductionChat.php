<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionChat extends Model
{
    use HasFactory;

    // Overrides Laravel's naming convention of tables and specifies a custom one.
    protected $table = 'production_chat';

    protected $fillable = [
        'user_id', 'employee_id', 'time_range_id', 'account_used', 'minutes_worked', 'chat_account_tool'
    ];

    /**
     * Get the employee associated with the chat production.
     */
    public function employee() {
        return $this->belongsTo('App\Models\Employee');
    }

    /**
     * Get the time ranges associated with the chat production.
     */
    public function time_range() {
        return $this->belongsTo('App\Models\TimeRange');
    }
}
