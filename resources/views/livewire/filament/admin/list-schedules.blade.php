<div class="w-full py-4">
    <h1 class="text-2xl font-bold tracking-wider text-center">COS Schedules</h1>

    @if ($employees->count() > 0)
        <p class="py-6">Schedule for the work week: <span class="text-slate-800 dark:text-slate-400">{{ $start_date }} - {{ $end_date }}</span></p>

        <div class="flex justify-end my-4">
            <a wire:navigate href="{{ $create_schedule_url }}">
                <button class="px-4 py-2 text-white transition-all duration-300 bg-orange-700 border border-orange-200 rounded hover:bg-orange-500 dark:bg-orange-500 dark:hover:bg-orange-700">Create Schedules</button>
            </a>
        </div>

        <table class="w-full">
            <thead class="bg-slate-200 dark:bg-slate-800">
                <th class="first-of-type:rounded-tl-xl">Employee</th>
                @foreach ($dates_after_start_date as $date)
                    <th class="text-center last-of-type:rounded-tr-xl" width="10%">
                        <p>{{ $date['date'] }}</p>
                        <p class="font-normal">{{ $date['day'] }}</p>
                    </th>
                @endforeach
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr class="odd:bg-gray-200 odd:dark:bg-gray-800 even:bg-slate-200 even:dark:bg-slate-800">
                        @php
                            // Check if employee has no last name filled
                            if (!$employee->user->last_name) {
                                $name_to_display = \Illuminate\Support\Str::title($employee->user->first_name). ' ' .\Illuminate\Support\Str::title($employee->user->maiden_name);
                            } else {
                                $name_to_display = $employee->user->last_name. ', ' .\Illuminate\Support\Str::title($employee->user->first_name). ' ' .\Illuminate\Support\Str::title($employee->user->maiden_name);
                            }
                        @endphp

                        <td class="px-3 py-2">{{ $name_to_display }}</td>

                        @for ($day_adder = 0; $day_adder < 7; $day_adder++)
                            @if ($employee->schedules->count() > 0)
                                @php
                                    $date = \Carbon\Carbon::parse($start_date)->addDays($day_adder)->format('Y-m-d');

                                    $has_schedule_for_date = $employee->schedules->firstWhere('date_of_shift', '=', $date);
                                @endphp

                                @if ($has_schedule_for_date)
                                    <td class="text-orange-600 transition-all duration-150 hover:font-bold hover:bg-slate-200 dark:text-orange-400 dark:hover:bg-slate-800">
                                        <a href="{{ \App\Filament\Resources\ScheduleResource::getUrl('edit', ['record' => $has_schedule_for_date->id]) }}">{{ $has_schedule_for_date->time_of_shift }}</a>
                                    </td>
                                @else
                                    <td class="italic tracking-wide text-center uppercase">REST</td>
                                @endif
                            @else
                                <td>&nbsp;</td>
                            @endif
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
