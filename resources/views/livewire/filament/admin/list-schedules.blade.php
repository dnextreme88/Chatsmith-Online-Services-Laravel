<div class="w-full py-4">
    <h1 class="text-2xl text-center font-bold tracking-wider">COS Schedules</h1>

    @if ($employees->count() > 0)
        <p class="py-6">Schedule for the work week: <span class="text-slate-800 dark:text-slate-400">{{ $start_date }} - {{ $end_date }}</span></p>

        <a wire:navigate class="my-4 flex justify-end" href="{{ $create_schedule_url }}">
            <button class="px-4 py-2 transition-all duration-300 text-white border rounded border-orange-200 bg-orange-700 hover:bg-orange-500 dark:bg-orange-500 dark:hover:bg-orange-700">Create Schedule</button>
        </a>

        <table>
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

                        <td class="py-2 px-3">
                            {{ $name_to_display }}

                            {{-- TODO: TO FINALIZE LOGIC
                            @auth
                                @if ($user->is_staff == 'True')
                                    (<i class="fa fa-magic"></i> <a href="/schedules/employees/{{ $employee->id }}/">Edit</a>)
                                @endif
                            @endauth
                            --}}
                        </td>

                        @for ($day_adder = 0; $day_adder < 7; $day_adder++)
                            @if ($employee->schedule->count() > 0)
                                @php
                                    $date = \Carbon\Carbon::parse($start_date)->addDays($day_adder)->format('Y-m-d');

                                    $has_schedule_for_date = $employee->schedule->firstWhere('date_of_shift', '=', $date);
                                @endphp

                                @if ($has_schedule_for_date)
                                    <td class="transition-all duration-150 text-orange-600 hover:font-bold hover:bg-slate-200 dark:text-orange-400 dark:hover:bg-slate-800">
                                        <a href="{{ \App\Filament\Resources\ScheduleResource::getUrl('edit', ['record' => $has_schedule_for_date->id]) }}">{{ $has_schedule_for_date->time_of_shift }}</a>
                                    </td>
                                @else
                                    <td class="text-center italic uppercase tracking-wide">REST</td>
                                @endif
                            @else
                                <td>&nbsp;</td>
                            @endif
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{-- TODO: TO FINALIZE LOGIC
    @elseif ($employees->count() == 0 && $user->is_staff == 'True')
        <p>No employees found. <a href="{{ route('employees.create') }}">Wanna create one now?</a></p>
    @elseif ($employees->count() == 0 && $user->is_staff == 'False')
        <p>No employees found.</p>
    --}}
    @endif
</div>
