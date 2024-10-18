<?php

namespace App\Livewire;

use App\Models\ProductionChat;
use App\Models\ProductionFocal;
use App\Models\ProductionPlate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ListProductions extends Component
{
    public $production_chat_accounts = [];
    public $production_focals = [];
    public $production_plates = [];
    public $date_today;
    public $date_start_of_week;
    public $date_end_of_week;
    public $table_type = 'daily';

    public function change_table_type($type)
    {
        $this->table_type = $type;

        $this->dispatch('production-tables-changed');
    }

    #[On('production-tables-changed')]
    public function render()
    {
        $this->date_today = Carbon::today(); // eg. 2020-02-14
        $this->date_start_of_week = $this->date_today->startOfWeek(Carbon::SUNDAY)
            ->format('Y-m-d H:i:s');
        $this->date_end_of_week = $this->date_today->endOfWeek(Carbon::SATURDAY)
            ->format('Y-m-d H:i:s');

        $prod_chat_accounts = ProductionChat::where('user_id', Auth::user()->id);
        $prod_focals = ProductionFocal::where('user_id', Auth::user()->id);
        $prod_plates = ProductionPlate::where('user_id', Auth::user()->id);

        if ($this->table_type == 'daily') {
            $this->production_chat_accounts = $prod_chat_accounts->dailyProductions();
            $this->production_focals = $prod_focals->dailyProductions();
            $this->production_plates = $prod_plates->dailyProductions();
        } else {
            $this->production_chat_accounts = $prod_chat_accounts->weeklyProductions($this->date_start_of_week, $this->date_end_of_week);
            $this->production_focals = $prod_focals->weeklyProductions($this->date_start_of_week, $this->date_end_of_week);
            $this->production_plates = $prod_plates->weeklyProductions($this->date_start_of_week, $this->date_end_of_week);
        }

        return view('livewire.list-productions');
    }
}
