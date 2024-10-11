<div x-data="{ selectedTableType: $wire.table_type }">
    <h3 class="text-2xl font-bold text-gray-600 dark:text-gray-300">My Productions</h3>

    <ul class="inline-flex my-6 text-lg bg-gray-200 rounded-tl-xl rounded-tr-xl dark:bg-gray-600">
        <li
            x-on:click="selectedTableType = 'daily'"
            x-bind:class="{ 'font-bold text-gray-200 dark:text-gray-800 bg-gray-700 dark:bg-gray-400': selectedTableType == 'daily', 'hover:text-gray-200 dark:hover:text-gray-800 hover:bg-gray-700 dark:hover:bg-gray-400': selectedTableType == 'weekly' }"
            wire:click="change_table_type('daily')"
            class="px-4 py-2 text-center transition-all duration-200 rounded-tl-xl hover:cursor-pointer"
        >
            Daily
        </li>
        <li
            x-on:click="selectedTableType = 'weekly'"
            x-bind:class="{ 'font-bold text-gray-200 dark:text-gray-800 bg-gray-700 dark:bg-gray-400': selectedTableType == 'weekly', 'hover:text-gray-200 dark:hover:text-gray-800 hover:bg-gray-700 dark:hover:bg-gray-400': selectedTableType == 'daily' }"
            wire:click="change_table_type('weekly')"
            class="px-4 py-2 text-center transition-all duration-200 border-l-2 rounded-tr-xl hover:cursor-pointer border-l-gray-600 dark:border-l-gray-300"
        >
            Weekly
        </li>
    </ul>

    <x-loading-indicator
        :loader_color_bg="'fill-gray-900 dark:fill-white'"
        :loader_color_spin="'fill-gray-900 dark:fill-white'"
        :size="8"
        :target="'change_table_type'"
        :text="'Loading data...'"
        class="ml-6"
    />

    <div wire:loading.remove wire:target="change_table_type" class="space-y-8">
        <table class="w-full border border-collapse border-gray-600 dark:border-gray-300">
            <caption class="py-4 text-xl text-gray-200 bg-gray-700 dark:bg-gray-400 dark:text-gray-800">Chat Account Productions</caption>

            @if (count($production_chat_accounts) > 0)
                <thead class="text-gray-200 bg-gray-600 dark:bg-gray-300 dark:text-gray-800">
                    <th class="py-1">Date</th>
                    <th class="py-1">Time Range</th>
                    <th class="py-1">Account Used</th>
                    <th class="py-1">Minutes Worked</th>
                    <th class="py-1">Chat Account Tool</th>
                </thead>

                <tbody class="text-gray-600 dark:text-gray-300">
                    @foreach ($production_chat_accounts as $key => $production_chat_account)
                        <tr wire:key="{{ $key }}">
                            <td class="py-2 text-center">{{ \Carbon\Carbon::parse($production_chat_account->created_at)->format('m/d/y') }}</td>
                            <td class="py-2 text-center">{{ $production_chat_account->time_range }}</td>
                            <td class="py-2 text-center">{{ \Illuminate\Support\Str::limit($production_chat_account->account_used, 32) }}</td>
                            <td class="py-2 text-center">{{ $production_chat_account->minutes_worked }}</td>
                            <td class="py-2 text-center">{{ $production_chat_account->chat_account_tool }}</td>
                        </tr>
                    @endforeach
                </tbody>
            @else
                <tbody class="text-gray-600 dark:text-gray-300">
                    <tr>
                        <td class="py-2 text-center text-gray-700 dark:text-gray-300">You currently don't have a record of chat account productions.</td>
                    </tr>
                </tbody>
            @endif
        </table>

        <table class="w-full border border-collapse border-gray-600 dark:border-gray-300">
            <caption class="py-4 text-xl text-gray-200 bg-gray-700 dark:bg-gray-400 dark:text-gray-800">Focal Productions</caption>

            @if (count($production_focals) > 0)
                <thead class="text-gray-200 bg-gray-600 dark:bg-gray-300 dark:text-gray-800">
                    <th class="py-1">Date</th>
                    <th class="py-1">Time Range</th>
                    <th class="py-1">Account Used</th>
                    <th class="py-1">Minutes Worked</th>
                    <th class="py-1">OOS</th>
                    <th class="py-1">Not OOS</th>
                    <th class="py-1">Discard</th>
                    <th class="py-1">Total</th>
                </thead>

                <tbody class="text-gray-600 dark:text-gray-300">
                    @foreach ($production_focals as $key => $production_focal)
                        <tr wire:key="{{ $key }}">
                            <td class="py-2 text-center">{{ \Carbon\Carbon::parse($production_focal->created_at)->format('m/d/y') }}</td>
                            <td class="py-2 text-center">{{ $production_focal->time_range }}</td>
                            <td class="py-2 text-center">{{ \Illuminate\Support\Str::limit($production_focal->account_used, 32) }}</td>
                            <td class="py-2 text-center">{{ $production_focal->minutes_worked }}</td>
                            <td class="py-2 text-center">{{ $production_focal->oos_count }}</td>
                            <td class="py-2 text-center">{{ $production_focal->not_oos_count }}</td>
                            <td class="py-2 text-center">{{ $production_focal->discard_count }}</td>
                            <td class="py-2 font-bold text-center">{{ $production_focal->total_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            @else
                <tbody class="text-gray-600 dark:text-gray-300">
                    <tr>
                        <td class="py-2 text-center text-gray-700 dark:text-gray-300">You currently don't have a record of focal productions.</td>
                    </tr>
                </tbody>
            @endif
        </table>

        <table class="w-full border border-collapse border-gray-600 dark:border-gray-300">
            <caption class="py-4 text-xl text-gray-200 bg-gray-700 dark:bg-gray-400 dark:text-gray-800">Plate Productions</caption>

            @if (count($production_plates) > 0)
                <thead class="text-gray-200 bg-gray-600 dark:bg-gray-300 dark:text-gray-800">
                    <th class="py-1">Date</th>
                    <th class="py-1">Time Range</th>
                    <th class="py-1">Account Used</th>
                    <th class="py-1">Minutes Worked</th>
                    <th class="py-1">Plate IQ Tool</th>
                    <th class="py-1">No. of Edits</th>
                    <th class="py-1">No. of Invoices Completed</th>
                    <th class="py-1">No. of Invoices Sent to Manager</th>
                    <th class="py-1">Total</th>
                </thead>

                <tbody class="text-gray-600 dark:text-gray-300">
                    @foreach ($production_plates as $key => $production_plate)
                        <tr wire:key="{{ $key }}">
                            <td class="py-2 text-center">{{ \Carbon\Carbon::parse($production_plate->created_at)->format('m/d/y') }}</td>
                            <td class="py-2 text-center">{{ $production_plate->time_range }}</td>
                            <td class="py-2 text-center">{{ \Illuminate\Support\Str::limit($production_plate->account_used, 32) }}</td>
                            <td class="py-2 text-center">{{ $production_plate->minutes_worked }}</td>
                            <td class="py-2 text-center">{{ $production_plate->plateiq_tool }}</td>
                            <td class="py-2 text-center">{{ $production_plate->no_of_edits }}</td>
                            <td class="py-2 text-center">{{ $production_plate->no_of_invoices_completed }}</td>
                            <td class="py-2 text-center">{{ $production_plate->no_of_invoices_sent_to_manager }}</td>
                            <td class="py-2 font-bold text-center">{{ $production_plate->total_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            @else
                <tbody class="text-gray-600 dark:text-gray-300">
                    <tr>
                        <td class="py-2 text-center text-gray-700 dark:text-gray-300">You currently don't have a record of plate productions.</td>
                    </tr>
                </tbody>
            @endif
        </table>
    </div>
</div>
