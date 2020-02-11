@extends('layouts.app')

@section('title')
{{ $user->name }}'s Profile
@endsection

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-2"> <!-- Requires $latest_announcement variable - fetch latest announcement -->
			<img src="{{ $latest_announcement->user->image }}" class="img-thumbnail img-responsive avatar-thumbnail-small" />
		</div>
		<div class="col-md-10 speech-bubble">
			@include('layouts.latest_announcement_pane')
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<span class="text-left float-left">Timestamps</span>
					<div id="time" class="text-right float-right"></div>

					<!-- Show current time script (based on local time on computer) -->
					<script type="text/javascript">
						function showCurrentTime() {
							var date = new Date(),
							current_date = new Date(
								date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds());

							document.getElementById('time').innerHTML = current_date.toLocaleString('en-US', {
								hour12: true, month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric'});
						}
						setInterval(showCurrentTime, 1000);
					</script>
				</div>

				<div class="card-body">
					<!-- Show success message when user has successfully timed in -->
					@if (session('success'))
						<div class="alert alert-success alert-block" role="alert">
							<button type="button" class="close" data-dismiss="alert">x</button>
							{{ session('success') }}
						</div>
					<!-- Show error if user has timed in and is not yet an employee -->
					@elseif ($errors->any())
						<div class="alert alert-danger" role="alert">
						@foreach($errors->all() as $error)
							{{ $error }}
						@endforeach
						</div>
					@endif
					<!-- CLOCK IN modal button -->
					<button type="button" class="btn btn-success btn-lg mb-2" data-toggle="modal" data-target="#clockInModal">CLOCK IN</button>
					<!-- Modal -->
					<div class="modal fade" id="clockInModal" tabindex="-1" role="dialog" aria-labelledby="clockInModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="clockInModalLabel">Select time of shift</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<!-- CLOCK IN FUNCTION - creates a time record for the user -->
								<form action="/profile/create_time_record/" method="POST" id="clock-in-form">
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
								<td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#clockOutModal">CLOCK OUT</button>
									<!-- CLOCK OUT Modal -->
									<div class="modal fade" id="clockOutModal" tabindex="-1" role="dialog" aria-labelledby="clockOutModal" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="clockOutModal">Confirm your clock out</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<!-- CLOCK OUT FUNCTION - updates timestamp_out field of the user -->
											<form action="/profile/time_record/{{ $time_record->id }}" method="POST" id="clock-out-form">
												@csrf
												<div class="modal-body">
													<strong><div id="time2"></div></strong><br />

													<!-- Show current time script (based on local time on computer) -->
													<script type="text/javascript">
														function showCurrentTime2() {
															var date = new Date(),
															current_date = new Date(
																date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds());

															document.getElementById('time2').innerHTML = current_date.toLocaleString('en-US', {
																hour12: true, month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric'});
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
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">Welcome, {{ $user->name }}!</div>

				<div class="card-body">
					<ul>
					   <!-- Check if user is a staff, then show admin panel link -->
						@if ($user->is_staff == 'True')
							<li><a href="/admin/">Admin Panel</a></li>
						@endif
						<li><a href="/profile/{{ $user->id}}/edit">Settings</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
