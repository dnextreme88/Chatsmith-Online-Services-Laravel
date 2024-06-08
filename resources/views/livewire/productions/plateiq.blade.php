<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Models\ProductionPlate;
use App\Models\TimeRange;
use App\Models\User;

new class extends Component
{
    public $user;
    public $time_ranges;
    public $plateiq_tool_choices = [];
    public int $employee_id = 0;
    public int $time_range_id = 0;
    public string $account_used = '';
    public int $minutes_worked = 0;
    public string $plateiq_tool = '';
    public int $no_of_edits = 0;
    public int $no_of_invoices_completed = 0;
    public int $no_of_invoices_sent_to_manager = 0;

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->time_ranges = TimeRange::all();
        $this->plateiq_tool_choices = [
            'Full Form', 'Needs Manager Review (NMR)', 'New Data Entry (NDE)', 'Pending Header', 'Statements', 'Verification'
        ];
        $this->employee_id = Auth::user()->employee->id ? Auth::user()->employee->id : 0;
        $this->time_range_id = 1;
        $this->account_used = Auth::user()->email ? Auth::user()->email : '';
        $this->minutes_worked = 0;
        $this->plateiq_tool = 'Full Form';
        $this->no_of_edits = 0;
        $this->no_of_invoices_completed = 0;
        $this->no_of_invoices_sent_to_manager = 0;
    }

    public function create_production_plate(): void
    {
        $this->validate([
            'no_of_edits' => 'numeric',
            'no_of_invoices_completed' => 'numeric',
            'no_of_invoices_sent_to_manager' => 'numeric',
            'minutes_worked' => ['required', 'max:60', 'min:1']
        ]);

        // Check if inputs are null
        if (($this->no_of_edits == '') || ($this->no_of_edits == ' ')) {
            $this->no_of_edits = 0;
        }

        if (($this->no_of_invoices_completed == '') || ($this->no_of_invoices_completed == ' ')) {
            $this->no_of_invoices_completed = 0;
        }

        if (($this->no_of_invoices_sent_to_manager == '') || ($this->no_of_invoices_sent_to_manager == ' ')) {
            $this->no_of_invoices_sent_to_manager = 0;
        }

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

        $this->reset(['time_range_id', 'minutes_worked', 'plateiq_tool', 'no_of_edits', 'no_of_invoices_completed', 'no_of_invoices_sent_to_manager']);

        $this->dispatch('plate-created');
    }
}
?>

<form wire:submit.prevent="create_production_plate" class="pb-4 px-2 space-y-4">
    <x-action-message class="text-green-500" on="plate-created">{{ __('Leadform for Plate IQ successfully submitted!') }}</x-action-message>

    <!-- Employee (Foreign key) -->
    <div class="grid grid-flow-row-dense grid-cols-3">
        <label class="pt-2" for="employee_id">Employee</label>

        <div class="grid grid-row col-span-2">
            <input wire:model="employee_id" type="hidden" id="employee_id" name="employee_id" />
            <input class="rounded shadow-none focus:border-amber-600 bg-gray-300" type="text" value="{{ $user->first_name. ' ' .$user->maiden_name. ' ' .$user->last_name }}" readonly />
        </div>
    </div>

    <!-- Time range -->
    <div class="grid grid-flow-row-dense grid-cols-3">
        <label class="pt-2" for="time_range_id">Time Range</label>

        <div class="grid grid-row col-span-2">
            <select class="rounded shadow-none focus:border-amber-600" wire:model="time_range_id" id="time_range_id" name="time_range_id">
                @foreach ($time_ranges as $time_range)
                    <option value="{{ $time_range->id }}">{{ $time_range->time_range }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Account used -->
    <div class="grid grid-flow-row-dense grid-cols-3">
        <label class="pt-2" for="account_used">Account Used</label>

        <div class="grid grid-row col-span-2">
            <input class="rounded shadow-none focus:border-amber-600 bg-gray-300" wire:model="account_used" type="text" id="account_used" name="account_used" readonly />
            <small class="text-slate-400">Change this value depending on what leadform you are using.</small>
        </div>
    </div>

    <!-- Minutes worked -->
    <div class="grid grid-flow-row-dense grid-cols-3">
        <label class="pt-2" for="minutes_worked">Minutes Worked</label>

        <div class="grid grid-row col-span-2">
            <input class="rounded shadow-none focus:border-amber-600" wire:model="minutes_worked" type="number" id="minutes_worked" name="minutes_worked" placeholder="0-60" min="1" max="60" />
        </div>
    </div>

    <!-- Plate IQ tool -->
    <div class="grid grid-flow-row-dense grid-cols-3">
        <label for="plateiq_tool" class="pt-2">Plate IQ Tool Used</label>

        <div class="grid grid-row col-span-2">
            <select class="rounded shadow-none focus:border-amber-600" wire:model="plateiq_tool" id="plateiq_tool" name="plateiq_tool">
                @foreach ($plateiq_tool_choices as $plateiq_tool)
                    <option value="{{ $plateiq_tool }}">{{ $plateiq_tool }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Number of edits -->
    <div class="grid grid-flow-row-dense grid-cols-3">
        <label for="no_of_edits" class="pt-2">Number of Edits</label>

        <div class="grid grid-row col-span-2">
            <input class="rounded shadow-none focus:border-amber-600" wire:model="no_of_edits" id="no_of_edits" type="number" name="no_of_edits" min="0">
            <small class="text-slate-400">You may put 0 or you can leave it as blank.</small>
        </div>
    </div>

    <!-- Number of invoices completed -->
    <div class="grid grid-flow-row-dense grid-cols-3">
        <label for="no_of_invoices_completed" class="pt-2">Number of Invoices Completed</label>

        <div class="grid grid-row col-span-2">
            <input class="rounded shadow-none focus:border-amber-600" wire:model="no_of_invoices_completed" id="no_of_invoices_completed" type="number" name="no_of_invoices_completed" min="0">
            <small class="text-slate-400">You may put 0 or you can leave it as blank.</small>
        </div>
    </div>

    <!-- Number of invoices sent to manager -->
    <div class="grid grid-flow-row-dense grid-cols-3">
        <label for="no_of_invoices_sent_to_manager" class="pt-2">Number of Invoices Sent to Manager</label>

        <div class="grid grid-row col-span-2">
            <input class="rounded shadow-none focus:border-amber-600" wire:model="no_of_invoices_sent_to_manager" id="no_of_invoices_sent_to_manager" type="number" name="no_of_invoices_sent_to_manager" min="0">
            <small class="text-slate-400">You may put 0 or you can leave it as blank.</small>
        </div>
    </div>

    <x-primary-button class="bg-green-600 hover:bg-green-400">{{ __('Submit Leadform') }}</x-primary-button>
</form>
