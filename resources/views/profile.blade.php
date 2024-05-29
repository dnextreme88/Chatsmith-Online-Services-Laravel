@extends('layouts.app')

@section('title')
{{ $user->first_name }}'s Profile
@endsection

@push('styles')
	<link href="{{ asset('css/Components/Profile/index.css') }}" rel="stylesheet">
	<link href="{{ asset('css/Components/LatestAnnouncement/index.css') }}" rel="stylesheet">
@endpush

@push('scripts')
	<script src="{{ asset('js/Announcements/latest_announcement.js') }}"></script>
@endpush

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
				<li class="breadcrumb-item">Profile</li>
			</ol>
		</div>

		@if ($latest_announcement && $is_active_employee)
			@include('layouts.latest_announcement_pane', ['latest_announcement' => $latest_announcement])
		@endif

		<div class="col-md-8 py-4">
			<div class="card">
				<div class="card-header">
					<span class="text-left float-start">Timestamps</span>

				@if ($is_active_employee)
					<div id="time" class="text-right float-end"></div>

					<!-- Show current time script (based on local time on computer) -->
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

				<div class="card-body">
					<!-- Show success message when user has successfully timed in -->
					@if (session('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<!-- Show error if user has timed in and is not yet an employee -->
					@elseif ($errors->any())
						<div class="alert alert-danger" role="alert">
						@foreach($errors->all() as $error)
							{{ $error }}
						@endforeach
						</div>
					@endif

					@if ($is_active_employee)
						<!-- CLOCK IN modal button -->
						<button type="button" class="btn btn-success btn-lg mb-2" data-bs-toggle="modal" data-bs-target="#clock-in-modal">CLOCK IN</button>

						<!-- Modal -->
						<div class="modal fade" id="clock-in-modal" tabindex="-1" role="dialog" aria-labelledby="clock-in-modal" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="clock-in-modal">Select time of shift</h5>
										<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<!-- CLOCK IN FUNCTION - creates a time record for the user -->
									<form action="{{ route('create_time_record') }}" method="POST" id="clock-in-form">
										@csrf
										<div class="modal-body">
											<!-- Time of Shift -->
											<div class="form-group row">
												<label for="time_of_shift" class="col-md-4 col-form-label text-md-right">Time of Shift</label>
												<div class="col-md-6">
													<select id="time_of_shift" class="form-control" name="time_of_shift">
														<option value="6AM-5PM">6 AM - 5 PM</option>
														<option value="8AM-7PM">8 AM - 7 PM</option>
														<option value="7PM-6AM">7 PM - 6 AM</option>
														<option value="9PM-8AM">9 PM - 8 AM</option>
													</select>
													<small class="text-muted">You must time in before your shift starts.</small>
												</div>
											</div>
										</div>
										<div class="modal-footer float-right">
											<input class="btn btn-success" type="submit" name="submit" value="TIME IN!">
										</div>
									</form>
								</div>
							</div>
						</div>
					@else
						<div class="alert alert-danger">You are not yet an employee or has left the company. Please contact the administrator.</div>
					@endif
					<!-- List of timestamps of the user -->
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
								<td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#clock-out-modal">CLOCK OUT</button>
									<!-- CLOCK OUT Modal -->
									<div class="modal fade" id="clock-out-modal" tabindex="-1" role="dialog" aria-labelledby="clock-out-modal" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="clock-out-modal">Confirm your clock out</h5>
												<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<!-- CLOCK OUT FUNCTION - updates timestamp_out field of the user -->
											<form action="/profile/time_record/{{ $time_record->id }}" method="POST" id="clock-out-form">
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
		</div>
		<div class="col-md-4 py-4">
			<div class="card">
				<div class="card-header">Welcome, {{ $user->first_name }}!</div>

				<div class="card-body profile-links">
					<ul>
					   <!-- Check if user is a staff, then show admin panel link -->
						@if ($user->is_staff == 'True')
							<li><a class="links" href="{{ route('admin_panel_home') }}">Admin Panel</a></li>
						@endif

						@if ($user->employee && $user->employee->is_active == 'True')
							<li><a class="links" href="/schedules/employees/{{ $user->employee->id }}/">My Schedules</a></li>
						@endif
						<li><a class="links" href="/profile/{{ $user->id}}/edit">Settings</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
