<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Models\ProductionChat;
use App\Models\TimeRange;
use App\Models\User;

new class extends Component
{
    public $user;
    public $time_ranges;
    public $chat_account_tool_choices = [];
    public int $employee_id = 0;
    public int $time_range_id = 0;
    public string $account_used = '';
    public int $minutes_worked = 0;
    public string $chat_account_tool = '';

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->time_ranges = TimeRange::all();
        $this->chat_account_tool_choices = [
            'Live Chat', 'PersistIQ', 'Smart Alto'
        ];
        $this->employee_id = Auth::user()->employee->id ? Auth::user()->employee->id : 0;
        $this->time_range_id = 1;
        $this->account_used = Auth::user()->email ? Auth::user()->email : '';
        $this->minutes_worked = 0;
        $this->chat_account_tool = 'Live Chat';
    }

    public function create_production_chat_account(): void
    {
        $this->validate(['minutes_worked' => ['required', 'max:60', 'min:1']]);

        ProductionChat::create([
            'user_id' => Auth::user()->id,
            'employee_id' => $this->employee_id,
            'time_range_id' => $this->time_range_id,
            'account_used' => $this->account_used,
            'minutes_worked' => $this->minutes_worked,
            'chat_account_tool' => $this->chat_account_tool
        ]);

        $this->reset(['time_range_id', 'minutes_worked', 'chat_account_tool']);

        $this->dispatch('chat-account-created');
    }
}
?>

<form wire:submit.prevent="create_production_chat_account" class="pb-4 px-2 space-y-4">
    <x-action-message class="text-green-500" on="chat-account-created">{{ __('Leadform for Chat Account successfully submitted!') }}</x-action-message>

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


        <!-- Chat Account tool -->
        <div class="grid grid-flow-row-dense grid-cols-3">
            <label for="chat_account_tool" class="pt-2">Chat Account Tool Used</label>

            <div class="grid grid-row col-span-2">
                <select class="rounded shadow-none focus:border-amber-600" wire:model="chat_account_tool" id="chat_account_tool" name="chat_account_tool">
                    @foreach ($chat_account_tool_choices as $chat_account_tool)
                        <option value="{{ $chat_account_tool }}">{{ $chat_account_tool }}</option>
                    @endforeach
                </select>
            </div>
        </div>

                {{-- <!-- Chat account tool -->
                <div class="form-group row">
                    <label for="chat_account_tool" class="col-md-4 col-form-label text-md-right">Chat Account Tool Used</label>

                    <div class="col-md-6">
                        <select id="chat_account_tool" class="form-control input-lg" name="chat_account_tool">
                        @foreach ($chat_account_tool_choices as $chat_account_tool)
                            <option value="{{ $chat_account_tool }}">{{ $chat_account_tool }}</option>
                        @endforeach
                        </select>
                    </div>
                </div> --}}

    <x-primary-button class="bg-green-600 hover:bg-green-400">{{ __('Submit Leadform') }}</x-primary-button>
</form>
