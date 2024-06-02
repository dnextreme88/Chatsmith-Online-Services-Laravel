<div>
    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'clock-out-modal')" class="bg-red-600 hover:bg-red-400 mb-2">{{ __('CLOCK OUT') }}</x-primary-button>

    <x-modal name="clock-out-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit.prevent="update_time_record" class="p-6" id="clock-out-form">
            <input wire:model="timerecord_id" type="hidden" value="timerecord_id" id="timerecord_id" name="timerecord_id" />

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Confirm your clock out') }}</h2>
            <p class="text-dark">You have to clock out before your shift ends. Press the <strong>CONFIRM CLOCK OUT</strong> button below to confirm your clock out.</p>

            <div class="mt-6 flex justify-end gap-4">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('CANCEL') }}</x-secondary-button>

                <x-primary-button x-on:click="$dispatch('close')" class="bg-red-600 hover:bg-red-400">{{ __('CONFIRM CLOCK OUT') }}</x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
