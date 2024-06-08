<div class="w-4/5 mx-auto py-4 px-2">
    <livewire:LatestAnnouncement />

    <div class="mt-3 flex justify-between gap-6">
        <div class="border w-75 flex flex-col rounded-md">
            <div class="p-2 mb-2 flex justify-between border-b-2 border-b-orange-500 bg-slate-200">
                <span class="text-start">Timestamps</span>

                @if ($is_active_employee)
                    <div id="time" class="text-right float-end"></div>
                @endif
            </div>

            <div class="p-2">
                <x-action-message class="text-red-500 me-3" on="clock-in-fail">{{ __('You are already clocked in. Please clock out your previous time in.') }}</x-action-message>
                <x-action-message class="text-green-500 me-3" on="clock-in-success">{{ __('You have successfully clocked in!') }}</x-action-message>
                <x-action-message class="text-green-500 me-3" on="clock-out-success">{{ __('You have successfully clocked out!') }}</x-action-message>

                <livewire:ClockIn />

                @if ($time_records->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <th>Time of Shift</th>
                            <th>Timestamp IN</th>
                            <th>Timestamp OUT</th>
                        </thead>
                        <tbody>
                        @foreach ($time_records as $time_record)
                            <tr>
                                <td>{{ $time_record->time_of_shift }}</td>
                                <td>{{ \Carbon\Carbon::parse($time_record->timestamp_in)->format('F j, Y - h:i:s A') }}</td>
                                <td>
                                    <!-- Show CLOCK OUT button once user has timed in -->
                                    @if ($time_record->timestamp_in == $time_record->timestamp_out)
                                        <livewire:ClockOut :timerecord_id="$time_record->id" />
                                    @else
                                        {{ \Carbon\Carbon::parse($time_record->timestamp_out)->format('F j, Y - h:i:s A') }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                {{ $time_records->links() }}
                @else
                    <p>You currently don't have a record of time-ins/time-outs.</p>
                @endif
            </div>
        </div>

        <div class="border w-25 flex flex-col rounded-md">
            <div class="p-2 mb-2 border-b-2 border-b-orange-500 bg-slate-200">
                <span class="text-start">Welcome, {{ $user->first_name }}!</span>
            </div>

            <div class="profile-links">
                <ul class="list-disc">
                    {{-- Check if user is a staff, then show admin panel link --}}
                    @if ($user->is_staff == 'True')
                        <li><a class="links" href="{{ route('admin_panel_home') }}">Admin Panel</a></li>
                    @endif

                    @if ($user->employee && $user->employee->is_active == 'True')
                        <li><a class="links" href="/schedules/employees/{{ $user->employee->id }}/" wire:navigate>My Schedules</a></li>
                    @endif

                    {{-- TODO: PLANNED AND UPCOMING NAV LINKS TO BE DONE SOON
                        <li><a class="links" href="#" wire:navigate>My Daily Productions</a></li>
                        <li><a class="links" href="#" wire:navigate>My Tasks</a></li>
                        <li><a class="links" href="#" wire:navigate>Payslip</a></li>
                    --}}

                    <li><a class="links" href="{{ route('dashboard.profile') }}" wire:navigate>Settings</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- Don't wrap @push('scripts') to this as it won't work, for some reason --}}
<script src="{{ asset('js/Dashboard/index.js') }}"></script>
