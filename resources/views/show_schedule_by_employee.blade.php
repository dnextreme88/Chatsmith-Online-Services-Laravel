@extends($layout)

@section('title')
	@guest
		Schedules of {{ $employee_by_id->user->first_name }} {{ $employee_by_id->user->last_name }}
	@else
		@auth
			@if ($user->is_staff == 'True')
				@if ($user == $employee_by_id->user)
					My Schedules
				@else
					Manage Schedules for {{ $employee_by_id->user->first_name }} {{ $employee_by_id->user->last_name }}
				@endif
			@else
				@if ($user == $employee_by_id->user)
					My Schedules
				@else
					Schedules of {{ $employee_by_id->user->first_name }} {{ $employee_by_id->user->last_name }}
				@endif
			@endif
		@endauth
	@endguest
@endsection

@section('content')
<div class="container">
	<div class="row">
	@guest
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('schedules.index') }}">Schedules</a></li>
				<li class="breadcrumb-item">Showing all schedules of {{ $employee_by_id->user->first_name }} {{ $employee_by_id->user->last_name }}</li>
			</ol>
		</div>
	@else
		@if ($user->is_staff == 'False')
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('schedules.index') }}">Schedules</a></li>
					@if ($user == $employee_by_id->user)
						<li class="breadcrumb-item">My Schedules</li>
					@else
						<li class="breadcrumb-item">Showing all schedules of {{ $employee_by_id->user->first_name }} {{ $employee_by_id->user->last_name }}</li>
					@endif
				</ol>
			</div>
		@endif
		<div class="col-md-12 text-center">
		@if ($user == $employee_by_id->user)
			<h1 class="text-center">My Schedules</h1>
		@else
			<h1 class="text-center">Showing all schedules of {{ $employee_by_id->user->first_name }} {{ $employee_by_id->user->last_name }}</h1>
		@endif
		</div>
	@endguest
	@if ($errors->any())
		<div class="alert alert-danger col-md-12" role="alert">
		@foreach($errors->all() as $error)
			<span>{{ $error }}</span>
		@endforeach
		</div>
	@endif
	@if ($schedules->count() > 0)
		<!-- Filter schedules by start date and end date -->
		<div class="col-md-12">
			<form class="form-inline" action="/schedules/employees/{{ $employee_by_id->id }}" method="POST">
			@csrf
				<!-- Start date -->
				<div class="form-group my-2">
					<label for="start_date" class="mx-2">Start date</label>
					<input id="start_date" class="form-control" type="text" name="start_date" value="{{ $start_date }}">
				</div>
				<!-- End date -->
				<div class="form-group my-2">
					<label for="end_date" class="mx-2">End date</label>
					<input id="end_date" class="form-control" type="text" name="end_date" value="{{ $end_date }}">
				</div>
				<div class="form-group m-2">
					<input class="btn btn-secondary" type="submit" name="submit" value="Filter Schedules">
					<button class="btn btn-secondary mx-2"><a href="/schedules/employees/{{ $employee_by_id->id }}" class="text-white" style="text-decoration: none;">Show all schedules</a></button>
				</div>
			</form>
		</div>
		<table class="table table-striped table-responsive">
			<thead>
				<th width="25%">Date of Shift</th>
				<th width="25%">Time of Shift</th>
				@if ($user->is_staff == 'True')
					<th width="100%">Actions</th>
				@endif
			</thead>
			<tbody>
			@foreach ($schedules as $schedule)
				<tr>
					<td>{{ \Carbon\Carbon::parse($schedule->date_of_shift)->format('F j, Y') }} ({{ \Carbon\Carbon::parse($schedule->date_of_shift)->format('l') }})</td>
					<td>{{ $schedule->time_of_shift }}</td>
					@auth
						@if ($user->is_staff == 'True')
							<td><ul class="list-inline">
								<li class="list-inline-item"><i class="fa fa-magic"></i> <a href="/schedules/{{ $schedule->id }}/edit/">Edit</a></li>
								<li class="list-inline-item">
									<form action="/schedules/employees/{{ $employee_by_id->id }}/{{ $schedule->id }}" method="POST">
										@csrf
										<i class="fa fa-trash"></i> <input class="text-danger delete-schedule-button" type="submit" name="submit" value="Delete" />
									</form>
								</li>
							</ul></td>
						@endif
					@endauth
				</tr>
			@endforeach
			</tbody>
		</table>
		{{ $schedules->links() }}
	@elseif ($schedules->count() == 0 && $user->is_staff == 'True')
		@if ($user == $employee_by_id->user)
			<p>You currently have no schedules.</p>
		@else
			<p>No schedules found for {{ $employee_by_id->user->first_name }} {{ $employee_by_id->user->last_name }}. <a href="{{ route('schedules.create') }}">Wanna create one now?</a></p>
		@endif
	@elseif ($schedules->count() == 0 && $user->is_staff == 'False')
		@if ($user == $employee_by_id->user)
			<p>You currently have no schedules.</p>
		@else
			<p>No schedules found for {{ $employee_by_id->user->first_name }} {{ $employee_by_id->user->last_name }}.</p>
		@endif
	@endif
	</div>
</div>

<script>
	$('#start_date').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
	});
	$('#end_date').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
	});
</script>
@endsection
