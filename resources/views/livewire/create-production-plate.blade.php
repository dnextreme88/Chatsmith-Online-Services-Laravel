<x-form-section submit="create_production_plate">
    <x-slot name="title">Plate Leadform</x-slot>

    <x-slot name="description">Plate Leadform for different tools</x-slot>

    <x-slot name="form">
        <div class="col-span-6">
            <x-label :value="'Employee ID'" for="employee_id" />

            <p class="w-full text-lg dark:text-gray-400">{{ $employee_id }}</p>
        </div>

        <div class="col-span-6">
            <x-label :value="'Time Range'" :is_required="true" for="time_range_id" />

            <x-select wire:model="time_range_id">
                <option value="">Select a time range</option>
                @foreach ($time_ranges as $time_range)
                    <option value="{{ $time_range->id }}">{{ $time_range->time_range }}</option>
                @endforeach
            </x-select>

            <x-input-error for="time_range_id" class="mt-2" />
        </div>

        <div class="col-span-6">
            <x-label :value="'Account Used'" :is_required="true" for="account_used" />

            <x-input wire:model="account_used" wire:target="toggle_is_use_own_email" wire:loading.attr="disabled" class="block w-full mt-1" id="account_used" name="account_used" type="text" required placeholder="username@domain.com" />

            <div class="flex items-center gap-2">
                <x-checkbox wire:model="is_use_own_email" wire:click="toggle_is_use_own_email" wire:target="toggle_is_use_own_email" wire:loading.attr="disabled" /> <span class="dark:text-gray-300">Use Chatsmith email?</span>

                <x-loading-indicator
                    :loader_color_bg="'fill-gray-900 dark:fill-white'"
                    :loader_color_spin="'fill-gray-900 dark:fill-white'"
                    :showText="false"
                    :size="4"
                    :target="'toggle_is_use_own_email'"
                />
            </div>

            <small class="dark:text-gray-400">Use the proper email depending on the account you used.</small>

            <x-input-error for="account_used" class="mt-2" />
        </div>

        <div class="col-span-6">
            <x-label :value="'Minutes Worked'" :is_required="true" for="minutes_worked" />

            <x-input wire:model="minutes_worked" class="block w-full mt-1" id="minutes_worked" name="minutes_worked" type="number" required placeholder="0 - 60" min="1" max="60" />

            <x-input-error for="minutes_worked" class="mt-2" />
        </div>

        <div class="col-span-6">
            <x-label :value="'PlateIQ Tool Used'" :is_required="true" for="plateiq_tool" />

            <x-select wire:model="plateiq_tool">
                <option value="">Select a PlateIQ tool</option>
                @foreach (\App\Enums\PlateIQTools::cases() as $tool)
                    <option value="{{ $tool->value }}">{{ $tool->value }}</option>
                @endforeach
            </x-select>

            <x-input-error for="plateiq_tool" class="mt-2" />
        </div>

        <div class="col-span-6">
            <x-label :value="'No. of Edits'" for="no_of_edits" />

            <x-input wire:model="no_of_edits" class="block w-full mt-1" id="no_of_edits" name="no_of_edits" type="number" />
            <small class="dark:text-gray-400">You may put 0 or you can leave it as blank.</small>

            <x-input-error for="no_of_edits" class="mt-2" />
        </div>

        <div class="col-span-6">
            <x-label :value="'No. of Invoices Completed'" for="no_of_invoices_completed" />

            <x-input wire:model="no_of_invoices_completed" class="block w-full mt-1" id="no_of_invoices_completed" name="no_of_invoices_completed" type="number" />
            <small class="dark:text-gray-400">You may put 0 or you can leave it as blank.</small>

            <x-input-error for="no_of_invoices_completed" class="mt-2" />
        </div>

        <div class="col-span-6">
            <x-label :value="'No. of Invoices Sent to Manager'" for="no_of_invoices_sent_to_manager" />

            <x-input wire:model="no_of_invoices_sent_to_manager" class="block w-full mt-1" id="no_of_invoices_sent_to_manager" name="no_of_invoices_sent_to_manager" type="number" />
            <small class="dark:text-gray-400">You may put 0 or you can leave it as blank.</small>

            <x-input-error for="no_of_invoices_sent_to_manager" class="mt-2" />
        </div>

        <div class="col-span-6">
            <x-button wire.loading.attr="disabled">
                <span wire:loading.flex wire:target="create_production_plate">
                    <x-loading-indicator
                        :loader_color_bg="'fill-gray-300 dark:fill-gray-800'"
                        :loader_color_spin="'fill-gray-300 dark:fill-gray-800'"
                        :showText="false"
                        :size="4"
                    />

                    <span class="ms-2">Submitting</span>
                </span>
                <span wire:loading.remove wire:target="create_production_plate">Submit</span>
            </x-button>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="text-green-500" on="production-plate-created">Leadform for Plate successfully submitted!</x-action-message>
    </x-slot>
</x-form-section>
