<div class="w-4/5 mx-auto py-4 px-2">
    <livewire:LatestAnnouncement />

    <div class="mt-3 flex justify-between gap-6">
        <div class="border w-75 flex flex-col rounded-md">
            <div class="p-2 mb-2 flex justify-between border-b-2 border-b-orange-500 bg-slate-200">
                <span class="text-start">Timestamps</span>

                @if ($is_active_employee)
                    <div id="time" class="text-right float-end"></div>

                    {{-- Show current time script (based on local time on computer) --}}
                    <script type="text/javascript">
                        function showCurrentTime() {
                            var date = new Date();
                            current_date = new Date(
                                date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds()
                            );

                            document.getElementById('time').innerHTML = current_date.toLocaleString('en-US', {
                                hour12: true, month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric'
                            });
                        }
                        setInterval(showCurrentTime, 1000);
                    </script>
                @endif
            </div>

            <div class="p-2">
                <x-action-message class="text-red-500 me-3" on="clock-in-fail">{{ __('You are already clocked in. Please clock out your previous time in.') }}</x-action-message>
                <x-action-message class="text-green-500 me-3" on="clock-in-success">{{ __('You have successfully clocked in!') }}</x-action-message>

                <livewire:ClockIn />

                {{-- TODO: TO OPTIMIZE CLOCK OUT MODAL SIMILAR TO WHAT I DID WITH THE CLOCK IN MODAL --}}
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
                                <!-- Show CLOCK OUT button once user has timed in -->
                                @if ($time_record->timestamp_in == $time_record->timestamp_out)
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#clock-out-modal">CLOCK OUT</button>
                                        <!-- CLOCK OUT Modal -->
                                        <div class="modal fade" id="clock-out-modal" tabindex="-1" role="dialog" aria-labelledby="clock-out-modal" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="text-black modal-title" id="clock-out-modal">Confirm your clock out</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <!-- CLOCK OUT FUNCTION - updates timestamp_out field of the user -->
                                                <form action="{{ route('dashboard.update_time_record', ['id' => $time_record->id]) }}" method="POST" id="clock-out-form">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <strong><div id="time2"></div></strong><br />

                                                        <!-- Show current time script (based on local time on computer) -->
                                                        <script type="text/javascript">
                                                            function showCurrentTime2() {
                                                                var date = new Date();
                                                                current_date = new Date(
                                                                    date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds()
                                                                );

                                                                document.getElementById('time2').innerHTML = current_date.toLocaleString('en-US', {
                                                                    hour12: true, month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric'
                                                                });
                                                            }
                                                            setInterval(showCurrentTime2, 1000);
                                                        </script>
                                                        <p>Are you sure you want to clock out? Please check the date and time above and then press <strong>CONFIRM CLOCK OUT</strong> to confirm your clock out.</p>
                                                    </div>
                                                    <div class="modal-footer float-right">
                                                        <input class="btn btn-danger" type="submit" name="submit" value="CONFIRM CLOCK OUT">
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @else
                                    <td>{{ \Carbon\Carbon::parse($time_record->timestamp_out)->format('F j, Y - h:i:s A') }}</td>
                                @endif
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
