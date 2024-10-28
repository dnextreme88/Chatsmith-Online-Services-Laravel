<?php

namespace App\Models;

use App\Enums\PlateIQTools;
use App\Models\Employee;
use App\Models\TimeRange;
use App\Models\Traits\ProductionTrait;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductionPlate extends Model
{
    use HasFactory;
    use ProductionTrait;

    // Overrides Laravel's naming convention of tables and specifies a custom one.
    protected $table = 'production_plate';

    protected $casts = ['plateiq_tool' => PlateIQTools::class];

    protected $fillable = [
        'user_id', 'employee_id', 'time_range_id', 'account_used', 'minutes_worked', 'plateiq_tool', 'no_of_edits', 'no_of_invoices_completed', 'no_of_invoices_sent_to_manager', 'total_count'
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
