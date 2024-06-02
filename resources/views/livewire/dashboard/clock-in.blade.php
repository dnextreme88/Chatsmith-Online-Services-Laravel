<div>
    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'clock-in-modal')" class="bg-green-600 hover:bg-green-400 mb-2">{{ __('CLOCK IN') }}</x-primary-button>

    <x-modal name="clock-in-modal" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit.prevent="create_time_record" class="p-6" id="clock-in-form">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Select time of shift') }}</h2>

            <div class="grid grid-rows-2 grid-flow-col gap-2">
                <div class="row-span-3">
                    <label for="time_of_shift">Time of Shift</label>
                </div>

                <div class="col">
                    <select wire:model="time_of_shift" id="time_of_shift" name="time_of_shift">
                        <option value="6AM-5PM">6 AM - 5 PM</option>
                        <option value="8AM-7PM">8 AM - 7 PM</option>
                        <option value="7PM-6AM">7 PM - 6 AM</option>
                        <option value="9PM-8AM">9 PM - 8 AM</option>
                    </select>
                </div>

                <div class="row-span-2 col-span-2">
                    <small class="text-muted">You must time in before your shift starts.</small>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('CANCEL') }}</x-secondary-button>

                <x-primary-button x-on:click="$dispatch('close')" class="bg-green-600 hover:bg-green-400">{{ __('TIME IN!') }}</x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
