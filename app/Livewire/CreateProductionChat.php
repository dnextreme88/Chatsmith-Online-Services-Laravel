<?php

namespace App\Livewire;

use App\Enums\ChatAccountTools;
use App\Models\ProductionChat;
use App\Models\TimeRange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateProductionChat extends Component
{
    public $time_ranges = [];
    public $employee_id;
    public $time_range_id;
    public $account_used;
    public $minutes_worked;
    public $chat_account_tool;

    public $is_use_own_email = false;

    public function create_production_chat_account()
    {
        $this->validate([
            'time_range_id' => ['required'],
            'account_used' => ['required', 'email'],
            'minutes_worked' => ['required', 'min:1', 'max:60'],
            'chat_account_tool' => ['required', Rule::enum(ChatAccountTools::class)]
        ]);

        ProductionChat::create([
            'user_id' => Auth::user()->id,
            'employee_id' => $this->employee_id,
            'time_range_id' => $this->time_range_id,
            'account_used' => $this->account_used,
            'minutes_worked' => $this->minutes_worked,
            'chat_account_tool' => $this->chat_account_tool
        ]);

        $this->reset();

        $this->dispatch('production-chat-account-created');
    }

    public function toggle_is_use_own_email()
    {
        $this->account_used = $this->is_use_own_email ? Auth::user()->email : '';
    }

    #[On('production-chat-account-created')]
    public function render()
    {
        $this->time_ranges = TimeRange::all();
        $this->employee_id = Auth::user()->employee->id ? Auth::user()->employee->id : 0;

        return view('livewire.create-production-chat');
    }
}
