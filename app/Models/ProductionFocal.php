<?php

namespace App\Models;

use App\Models\Employee;
use App\Models\TimeRange;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductionFocal extends Model
{
    use HasFactory;

    // Overrides Laravel's naming convention of tables and specifies a custom one.
    protected $table = 'production_focal';

    protected $fillable = [
        'user_id', 'employee_id', 'time_range_id', 'account_used', 'minutes_worked', 'oos_count', 'not_oos_count', 'discard_count', 'total_count'
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
}
