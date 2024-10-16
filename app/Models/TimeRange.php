<?php

namespace App\Models;

use App\Models\ProductionChat;
use App\Models\ProductionFocal;
use App\Models\ProductionPlate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimeRange extends Model
{
    use HasFactory;

    protected $fillable = ['time_range'];

    // Relationships
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
}
