<div class="py-12">
    <x-form-section submit="create_form_request">
        <x-slot name="title">Form Requests</x-slot>

        <x-slot name="description">Please fill out the form for your request. All requests are subjected for approval by the staff members and admins.</x-slot>

        <x-slot name="form">
            <div class="col-span-6">
                <x-label :value="'Request Type'" :is_required="true" for="request_type" />

                <x-select wire:model="request_type">
                    <option value="">Select your request</option>
                    @foreach (\App\Enums\RequestTypes::cases() as $request_type)
                        <option value="{{ $request_type->value }}">{{ $request_type->value }}</option>
                    @endforeach
                </x-select>

                <x-input-error for="request_type" class="mt-2" />
            </div>

            <div class="col-span-6 mt-4">
                <x-label :is_required="true" :value="'Reason'" />

                <x-textarea :livewire_event_to_listen="'form-request-created'" :placeholder_message="'Please enter your reason here'" wire:model="reason" class="resize-none" id="reason" maxlength="255" rows="7"></x-textarea>

                <x-input-error for="reason" class="mt-2" />
            </div>

            <div class="col-span-6 mt-4">
                <x-label :is_required="true" :value="'Starting date'" />

                <x-input wire:model="date_from" class="block w-full mt-1" type="date" id="date_from" autocomplete="date_from" />
                <small class="text-slate-700 dark:text-slate-300">Format: DD/MM/YYYY</small>

                <x-input-error for="date_from" class="mt-2" />
            </div>

            <div class="col-span-6 mt-4">
                <x-label :is_required="true" :value="'Ending date'" />

                <x-input wire:model="date_to" class="block w-full mt-1" type="date" id="date_to" autocomplete="date_to" />
                <small class="text-slate-700 dark:text-slate-300">Format: DD/MM/YYYY</small>

                <x-input-error for="date_to" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="text-green-700 me-3 dark:text-green-200" on="form-request-created">Your response has been received. We will be reaching out to you in a few days.</x-action-message>

            <x-button wire:loading.attr="disabled">Submit</x-button>
        </x-slot>
    </x-form-section>
</div>
