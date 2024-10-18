<?php

namespace App\Models\Traits;

use Carbon\Carbon;

// Traits allow use to make functions available to another class (eg. in a model) when we define them with a use command
// eg. use ProductionTrait;
trait ProductionTrait
{
    // Prefixing functions with scope allow you to chain query constraints.
    // which is useful for code readability and the DRY principle
    // Sample usage: $daily_productions = ProductionChat::dailyProductions();
    protected function scopeDailyProductions($query)
    {
        return $query->whereDate('created_at', Carbon::today()->format('Y-m-d'))
           ->orderBy('created_at', 'DESC')
           ->get();
    }

    protected function scopeWeeklyProductions($query, $date_start, $date_end)
    {
        return $query->whereBetween('created_at', [$date_start, $date_end])
            ->orderBy('created_at', 'DESC')
            ->get();
    }
}
