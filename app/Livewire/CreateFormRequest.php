<?php

namespace App\Livewire;

use App\Enums\RequestTypes;
use App\Models\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateFormRequest extends Component
{
    public $request_type;
    public $reason;
    public $date_from;
    public $date_to;

    public function create_form_request()
    {
        $this->validate([
            'reason' => ['required', 'min:5', 'max:255'],
            'request_type' => ['required', Rule::enum(RequestTypes::class)],
            'date_from' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:today'],
            'date_to' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:date_from']
        ]);

        FormRequest::create([
            'user_id' => Auth::user()->id,
            'reason' => $this->reason,
            'request_type' => $this->request_type,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to
        ]);

        $this->reset();

        // TODO: TO ADD NOTIFICATION TO NOTIFY STAFF MEMBERS WHENEVER A FORM REQUEST IS CREATED

        $this->dispatch('form-request-created');
    }

    #[On('form-request-created')]
    public function render()
    {
        return view('livewire.create-form-request');
    }
}
