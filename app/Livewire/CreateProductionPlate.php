<?php

namespace App\Livewire;

use App\Models\ProductionPlate;
use App\Models\TimeRange;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateProductionPlate extends Component
{
    public $time_ranges = [];
    public $employee_id;
    public $time_range_id;
    public $account_used;
    public $minutes_worked;
    public $plateiq_tool;
    public $no_of_edits = 0;
    public $no_of_invoices_completed = 0;
    public $no_of_invoices_sent_to_manager = 0;

    public $is_use_own_email = false;

    public function create_production_plate()
    {
        $this->validate([
            'time_range_id' => ['required'],
            'account_used' => ['required', 'email'],
            'minutes_worked' => ['required', 'min:1', 'max:60'],
            'plateiq_tool' => ['required'],
            'no_of_edits' => ['sometimes', 'nullable', 'numeric'],
            'no_of_invoices_completed' => ['sometimes', 'nullable', 'numeric'],
            'no_of_invoices_sent_to_manager' => ['sometimes', 'nullable', 'numeric']
        ]);

        // Check if inputs are null
        $this->no_of_edits = !$this->no_of_edits ? 0 : $this->no_of_edits;
        $this->no_of_invoices_completed = !$this->no_of_invoices_completed ? 0 : $this->no_of_invoices_completed;
        $this->no_of_invoices_sent_to_manager = !$this->no_of_invoices_sent_to_manager ? 0 : $this->no_of_invoices_sent_to_manager;

        $total_count = $this->no_of_edits + $this->no_of_invoices_completed + $this->no_of_invoices_sent_to_manager;

        ProductionPlate::create([
            'user_id' => Auth::user()->id,
            'employee_id' => $this->employee_id,
            'time_range_id' => $this->time_range_id,
            'account_used' => $this->account_used,
            'minutes_worked' => $this->minutes_worked,
            'plateiq_tool' => $this->plateiq_tool,
            'no_of_edits' => $this->no_of_edits,
            'no_of_invoices_completed' => $this->no_of_invoices_completed,
            'no_of_invoices_sent_to_manager' => $this->no_of_invoices_sent_to_manager,
            'total_count' => $total_count
        ]);

        $this->reset();

        $this->dispatch('production-plate-created');
    }

    public function toggle_is_use_own_email()
    {
        $this->account_used = $this->is_use_own_email ? Auth::user()->email : '';
    }

    #[On('production-plate-created')]
    public function render()
    {
        $this->time_ranges = TimeRange::all();
        $this->employee_id = Auth::user()->employee->id ? Auth::user()->employee->id : 0;

        return view('livewire.create-production-plate');
    }
}
