<x-form-section submit="create_production_chat_account">
    <x-slot name="title">Chat Account Leadform</x-slot>

    <x-slot name="description">Chat Account Leadform for different tools</x-slot>

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
            <x-label :value="'Chat Account Tool Used'" :is_required="true" for="chat_account_tool" />

            <x-select wire:model="chat_account_tool">
                <option value="">Select a chat account tool</option>
                @foreach (\App\Enums\ChatAccountTools::cases() as $tool)
                    <option value="{{ $tool->value }}">{{ $tool->value }}</option>
                @endforeach
            </x-select>

            <x-input-error for="chat_account_tool" class="mt-2" />
        </div>

        <div class="col-span-6">
            <x-button wire.loading.attr="disabled">
                <span wire:loading.flex wire:target="create_production_chat_account">
                    <x-loading-indicator
                        :loader_color_bg="'fill-gray-300 dark:fill-gray-800'"
                        :loader_color_spin="'fill-gray-300 dark:fill-gray-800'"
                        :showText="false"
                        :size="4"
                    />

                    <span class="ms-2">Submitting</span>
                </span>
                <span wire:loading.remove wire:target="create_production_chat_account">Submit</span>
            </x-button>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="text-green-500" on="production-chat-account-created">Leadform for Chat Account successfully submitted!</x-action-message>
    </x-slot>
</x-form-section>
