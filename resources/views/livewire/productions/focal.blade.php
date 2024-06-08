<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Models\ProductionFocal;
use App\Models\TimeRange;
use App\Models\User;

new class extends Component
{
    public $user;
    public $time_ranges;
    public int $employee_id = 0;
    public int $time_range_id = 0;
    public string $account_used = '';
    public int $minutes_worked = 0;
    public int $oos_count = 0;
    public int $not_oos_count = 0;
    public int $discard_count = 0;

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->time_ranges = TimeRange::all();
        $this->employee_id = Auth::user()->employee->id ? Auth::user()->employee->id : 0;
        $this->time_range_id = 1;
        $this->account_used = Auth::user()->email ? Auth::user()->email : '';
        $this->minutes_worked = 0;
        $this->oos_count = 0;
        $this->not_oos_count = 0;
        $this->discard_count = 0;
    }

    public function create_production_focal(): void
    {
        $this->validate([
            'oos_count' => 'numeric',
            'not_oos_count' => 'numeric',
            'discard_count' => 'numeric',
            'minutes_worked' => ['required', 'max:60', 'min:1']
        ]);

        // Check if inputs are null
        if (($this->oos_count == '') || ($this->oos_count == ' ')) {
            $this->oos_count = 0;
        }

        if (($this->not_oos_count == '') || ($this->not_oos_count == ' ')) {
            $this->not_oos_count = 0;
        }

        if (($this->discard_count == '') || ($this->discard_count == ' ')) {
            $this->discard_count = 0;
        }

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

        $this->reset(['time_range_id', 'minutes_worked', 'oos_count', 'not_oos_count', 'discard_count']);

        $this->dispatch('focal-created');
    }
}
?>

<form wire:submit.prevent="create_production_focal" class="pb-4 px-2 space-y-4">
    <x-action-message class="text-green-500" on="focal-created">{{ __('Leadform for Focal successfully submitted!') }}</x-action-message>

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

    <!-- OOS count -->
    <div class="grid grid-flow-row-dense grid-cols-3">
        <label class="pt-2" for="oos_count">Number of OOS (Yes)</label>

        <div class="grid grid-row col-span-2">
            <input class="rounded shadow-none focus:border-amber-600" wire:model="oos_count" id="oos_count" type="number" name="oos_count" />
            <small class="text-slate-400">You may put 0 or you can leave it as blank.</small>
        </div>
    </div>

    <!-- Not OOS count -->
    <div class="grid grid-flow-row-dense grid-cols-3">
        <label class="pt-2" for="not_oos_count">Number of Not OOS (No)</label>

        <div class="grid grid-row col-span-2">
            <input class="rounded shadow-none focus:border-amber-600" wire:model="not_oos_count" id="not_oos_count" type="number" name="not_oos_count" />
            <small class="text-slate-400">You may put 0 or you can leave it as blank.</small>
        </div>
    </div>

    <!-- Discard count -->
    <div class="grid grid-flow-row-dense grid-cols-3">
        <label class="pt-2" for="discard_count">Number of Discarded Images</label>

        <div class="grid grid-row col-span-2">
            <input class="rounded shadow-none focus:border-amber-600" wire:model="discard_count" id="discard_count" type="number" name="discard_count" />
            <small class="text-slate-400">You may put 0 or you can leave it as blank.</small>
        </div>
    </div>

    <x-primary-button class="bg-green-600 hover:bg-green-400">{{ __('Submit Leadform') }}</x-primary-button>
</form>
