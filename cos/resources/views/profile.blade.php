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
								date.getFullYear(),
								date.getMonth(),
								date.getDate(),
								date.getHours(),
								date.getMinutes(),
								date.getSeconds()
							);
							document.getElementById('time').innerHTML = current_date.toLocaleString('en-US', {
								hour12: true, month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric'});
						}
						setInterval(showCurrentTime, 1000);
					</script>
				</div>

				<div class="card-body">
					<!-- list of timestamps of user -->
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
