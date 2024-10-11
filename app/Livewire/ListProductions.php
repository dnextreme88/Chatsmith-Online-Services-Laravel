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
    public $table_type;

    public function change_table_type($type)
    {
        $this->table_type = $type;

        $this->dispatch('production-tables-changed');
    }

    public function mount()
    {
        $date_today = Carbon::today(); // eg. 2020-02-14

        $this->date_start_of_week = $date_today->startOfWeek(Carbon::SUNDAY)->format('Y-m-d H:i:s');
        $this->date_end_of_week = $date_today->endOfWeek(Carbon::SATURDAY)->format('Y-m-d H:i:s');
        $this->table_type = 'daily';
    }

    #[On('production-tables-changed')]
    public function render()
    {
        $this->date_today = Carbon::today(); // eg. 2020-02-14

        $prod_chat_accounts = ProductionChat::select([
                'time_ranges.time_range',
                'production_chat.account_used',
                'production_chat.minutes_worked',
                'production_chat.created_at',
                'production_chat.chat_account_tool'
            ])
            ->join('time_ranges', 'time_ranges.id', 'production_chat.time_range_id')
            ->where('production_chat.user_id', Auth::user()->id);

        $prod_focals = ProductionFocal::select([
                'time_ranges.time_range',
                'production_focal.account_used',
                'production_focal.minutes_worked',
                'production_focal.created_at',
                'production_focal.oos_count',
                'production_focal.not_oos_count',
                'production_focal.discard_count',
                'production_focal.total_count'
            ])
            ->join('time_ranges', 'time_ranges.id', 'production_focal.time_range_id')
            ->where('production_focal.user_id', Auth::user()->id);

        $prod_plates = ProductionPlate::select([
                'time_ranges.time_range',
                'production_plate.account_used',
                'production_plate.minutes_worked',
                'production_plate.created_at',
                'production_plate.plateiq_tool',
                'production_plate.no_of_edits',
                'production_plate.no_of_invoices_completed',
                'production_plate.no_of_invoices_sent_to_manager',
                'production_plate.total_count'
            ])
            ->join('time_ranges', 'time_ranges.id', 'production_plate.time_range_id')
            ->where('production_plate.user_id', Auth::user()->id);

        if ($this->table_type == 'daily') {
            $this->production_chat_accounts = $prod_chat_accounts->whereDate('production_chat.created_at', $this->date_today->format('Y-m-d'))
                ->orderBy('production_chat.created_at', 'DESC')
                ->get();

            $this->production_focals = $prod_focals->whereDate('production_focal.created_at', $this->date_today->format('Y-m-d'))
                ->orderBy('production_focal.created_at', 'DESC')
                ->get();

            $this->production_plates = $prod_plates->whereDate('production_plate.created_at', $this->date_today->format('Y-m-d'))
                ->orderBy('production_plate.created_at', 'DESC')
                ->get();
        } else {
            $this->production_chat_accounts = $prod_chat_accounts->whereBetween('production_chat.created_at', [$this->date_start_of_week, $this->date_end_of_week])
                ->orderBy('production_chat.created_at', 'DESC')
                ->get();

            $this->production_focals = $prod_focals->whereBetween('production_focal.created_at', [$this->date_start_of_week, $this->date_end_of_week])
                ->orderBy('production_focal.created_at', 'DESC')
                ->get();

            $this->production_plates = $prod_plates->whereBetween('production_plate.created_at', [$this->date_start_of_week, $this->date_end_of_week])
                ->orderBy('production_plate.created_at', 'DESC')
                ->get();
        }

        return view('livewire.list-productions');
    }
}
