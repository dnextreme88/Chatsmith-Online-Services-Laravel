<?php

namespace App\Livewire;

use App\Models\FormRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListFormRequest extends Component
{
    public $view_form_request_modal = false;
    public $viewed_form_request;

    public function toggle_view_form_request_modal($form_request_id)
    {
        $this->view_form_request_modal = true;
        $this->viewed_form_request = FormRequest::find($form_request_id);
    }

    public function render()
    {
        $form_requests = FormRequest::where('user_id', Auth::user()->id)->orderBy('id', 'desc')
            ->paginate(5);

        return view('livewire.list-form-request', compact('form_requests'));
    }
}
