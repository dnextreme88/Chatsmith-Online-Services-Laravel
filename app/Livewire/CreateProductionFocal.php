<?php

namespace App\Livewire;

use App\Models\ProductionFocal;
use App\Models\TimeRange;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateProductionFocal extends Component
{
    public $time_ranges = [];
    public $employee_id;
    public $time_range_id;
    public $account_used;
    public $minutes_worked;
    public $oos_count = 0;
    public $not_oos_count = 0;
    public $discard_count = 0;

    public $is_use_own_email = false;

    public function create_production_focal()
    {
        $this->validate([
            'time_range_id' => ['required'],
            'account_used' => ['required', 'email'],
            'minutes_worked' => ['required', 'min:1', 'max:60'],
            'oos_count' => ['sometimes', 'nullable', 'numeric'],
            'not_oos_count' => ['sometimes', 'nullable', 'numeric'],
            'discard_count' => ['sometimes', 'nullable', 'numeric']
        ]);

        // Check if inputs are null
        $this->oos_count = !$this->oos_count ? 0 : $this->oos_count;
        $this->not_oos_count = !$this->not_oos_count ? 0 : $this->not_oos_count;
        $this->discard_count = !$this->discard_count ? 0 : $this->discard_count;

        $total_count = $this->oos_count + $this->not_oos_count + $this->discard_count;

        ProductionFocal::create([
            'user_id' => Auth::user()->id,
            'employee_id' => $this->employee_id,
            'time_range_id' => $this->time_range_id,
            'account_used' => $this->account_used,
            'minutes_worked' => $this->minutes_worked,
            'oos_count' => $this->oos_count,
            'not_oos_count' => $this->not_oos_count,
            'discard_count' => $this->discard_count,
            'total_count' => $total_count
        ]);

        $this->reset();

        $this->dispatch('production-focal-created');
    }

    public function toggle_is_use_own_email()
    {
        $this->account_used = $this->is_use_own_email ? Auth::user()->email : '';
    }

    #[On('production-focal-created')]
    public function render()
    {
        $this->time_ranges = TimeRange::all();
        $this->employee_id = Auth::user()->employee->id ? Auth::user()->employee->id : 0;

        return view('livewire.create-production-focal');
    }
}
