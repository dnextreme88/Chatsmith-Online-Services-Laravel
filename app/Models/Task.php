<?php

namespace App\Models;

use App\Enums\TaskNames;
use App\Models\Employee;
use App\Models\TimeRange;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $casts = ['task_name' => TaskNames::class];

    protected $fillable = [
        'user_id', 'employee_id', 'time_range_id', 'task_name', 'task_date'
    ];

    // Relationships
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function time_range(): BelongsTo
    {
        return $this->belongsTo(TimeRange::class, 'time_range_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope functions
    public function scopeHasTaskOnTimeAndDate($query, $time_range_id, $task_date)
    {
        return $query->where('time_range_id', $time_range_id)
            ->where('task_date', $task_date)
            ->exists();
    }
}
