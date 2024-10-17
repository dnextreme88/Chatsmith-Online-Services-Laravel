<div x-data="{ timeRecordIdForClockingOut: 0 }">
    <h3 class="text-2xl font-bold text-gray-600 dark:text-gray-300">Clock-Ins / Clock-Outs</h3>

    <x-secondary-button wire:click="$toggle('clock_in_modal')" class="my-4 bg-green-600 hover:bg-green-400">Clock in</x-secondary-button>

    <x-action-message class="text-green-500 me-3" on="clock-in-success">You have successfully clocked in!</x-action-message>
    <x-action-message class="text-green-500 me-3" on="clock-out-success">You have successfully clocked out!</x-action-message>

    <table class="w-full border border-collapse border-gray-600 dark:border-gray-300 {{ count($time_records) > 0 ? 'my-6' : '' }}">
        @if (count($time_records) > 0)
            <thead class="text-gray-200 bg-gray-600 dark:bg-gray-300 dark:text-gray-800">
                <th class="py-1">Time of Shift</th>
                <th class="py-1">Timestamp IN</th>
                <th class="py-1">Timestamp OUT</th>
            </thead>
        @endif

        <tbody class="text-gray-600 dark:text-gray-300">
            @forelse ($time_records as $key => $time_record)
                <tr wire:key="{{ $key }}">
                    <td class="text-center">{{ $time_record->time_of_shift }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($time_record->timestamp_in)->format('m/d/y: h:i:s A') }}</td>
                    <td class="py-2 text-center">
                        @if ($time_record->timestamp_in == $time_record->timestamp_out)
                            <button x-on:click="timeRecordIdForClockingOut = {{ $time_record->id }}" wire:click="$toggle('clock_out_modal')" class="px-4 py-2 text-sm text-white transition duration-150 bg-red-600 rounded-lg hover:bg-red-800 dark:hover:bg-red-600 dark:bg-red-800">CLOCK OUT</p>
                        @else
                            {{ \Carbon\Carbon::parse($time_record->timestamp_out)->format('m/d/Y - h:i:s A') }}
                        @endif
                    </td>
                </tr>
            @empty
                <p class="dark:text-white">You currently don't have a record of time-ins/time-outs.</p>
            @endforelse
        </tbody>
    </table>

    @if (count($time_records) > 0)
        {{ $time_records->links() }}
    @endif

    <x-modal wire:model="clock_in_modal">
        <x-form-section :submit="'create_time_record'" class="p-6 bg-gray-300 dark:bg-gray-800">
            <x-slot name="title">Select your shift</x-slot>

            <x-slot name="description">You must time in before your shift starts.</x-slot>

            <x-slot name="form">
                <div class="col-span-6">
                    <x-label :value="'Time of Shift'" :is_required="true" for="time_of_shift" />

                    <x-select wire:model="time_of_shift">
                        <option value="">Select a shift</option>
                        @foreach ($time_of_shifts as $time_of_shift)
                            <option value="{{ $time_of_shift }}">{{ $time_of_shift }}</option>
                        @endforeach
                    </x-select>

                    <x-input-error class="mt-2" for="time_of_shift" />
                </div>

                <div class="col-span-6">
                    <x-button wire.loading.attr="disabled">
                        <span wire:loading.flex wire:target="create_time_record">
                            <x-loading-indicator
                                :loader_color_bg="'fill-gray-300 dark:fill-gray-800'"
                                :loader_color_spin="'fill-gray-300 dark:fill-gray-800'"
                                :showText="false"
                                :size="4"
                            />

                            <span class="ms-2">Clocking in</span>
                        </span>
                        <span wire:loading.remove wire:target="create_time_record">Confirm Clock In</span>
                    </x-button>
                </div>
            </x-slot>
        </x-form-section>
    </x-modal>

    <x-confirmation-modal wire:model="clock_out_modal">
        <x-slot name="title">Confirm your Clock Out?</x-slot>

        <x-slot name="content">You have to clock out when your shift ends. Do you really want to clock out?</x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('clock_out_modal')" wire:loading.attr="disabled">Not yet</x-secondary-button>

            <x-danger-button wire:loading.attr="disabled" class="ms-2">
                <span wire:loading.flex wire:target="update_time_record">
                    <x-loading-indicator
                        :loader_color_bg="'fill-gray-300 dark:fill-gray-800'"
                        :loader_color_spin="'fill-gray-300 dark:fill-gray-800'"
                        :showText="false"
                        :size="4"
                    />

                    <span class="ms-2">Clocking Out</span>
                </span>
                <span wire:loading.remove wire:click="update_time_record(timeRecordIdForClockingOut)">Confirm Clock Out</span>
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
