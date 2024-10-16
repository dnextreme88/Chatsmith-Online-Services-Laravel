<?php

namespace App\Models;

use App\Models\ProductionChat;
use App\Models\ProductionFocal;
use App\Models\ProductionPlate;
use App\Models\Schedule;
use App\Models\Task;
use App\Models\TimeRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'employee_number', 'employee_type', 'designation', 'role', 'date_tenure', 'is_active'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function production_chats(): HasMany
    {
        return $this->hasMany(ProductionChat::class);
    }

    public function production_focals(): HasMany
    {
        return $this->hasMany(ProductionFocal::class);
    }

    public function production_plates(): HasMany
    {
        return $this->hasMany(ProductionPlate::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function time_records(): HasMany
    {
        return $this->hasMany(TimeRecord::class);
    }
}
