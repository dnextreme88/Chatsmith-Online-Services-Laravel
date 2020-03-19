@extends($layout)

@section('title')
	@guest
		Schedules
	@else
		@auth
			@if ($user->is_staff == 'True')
				Manage Schedules
			@else
				Schedules
			@endif
		@endauth
	@endguest
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row justify-content-center">
			@guest
				<div class="col-md-12">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
						<li class="breadcrumb-item">Schedules</li>
					</ol>
				</div>
			@else
				@if ($user->is_staff == 'False')
					<div class="col-md-12">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
							<li class="breadcrumb-item">Schedules</li>
						</ol>
					</div>
				@endif
			@endguest
			<div class="col-md-12">
			@if (session('success'))
				<div class="alert alert-success alert-block" role="alert">
					<button type="button" class="close" data-dismiss="alert">x</button>
					{{ session('success') }}
				</div>
			@endif
			@if ($employees->count() > 0)
				<h2 class="text-center">COS Schedules 2020</h2>
				<form action="{{ route('view_schedule_by_week') }}" method="POST">
					@csrf
					<!-- Start of Week picker -->
					<div class="form-group row p-2">
						<label for="start_of_week" class="col-md-4 col-form-label text-md-right">View schedule by week:</label>

						<div class="col-md-4">
							<input id="start_of_week" class="form-control input-lg" type="text" name="start_of_week" value="{{ $start_date }}">
						</div>

						<div class="col-md-4">
							<input class="btn btn-secondary" type="submit" name="submit" value="GO">
						</div>
					</div>
				</form>
				<h3>Schedule for the work week: {{ \Carbon\Carbon::parse($start_date)->format('F j') }} - {{ \Carbon\Carbon::parse($end_date)->format('F j, Y') }}</h3>
				<table class="table table-bordered table-responsive">
					<thead>
						<th>Employee</th>
							@for ($i = 0; $i < 7; $i++)
								<th width="10%" class="text-center">
									{{ \Carbon\Carbon::parse($start_date)->addDays($i)->format('F j') }}<br />
									{{ \Carbon\Carbon::parse($start_date)->addDays($i)->format('D') }}
								</th>
							@endfor
					</thead>
					<tbody>
					@foreach ($employees as $employee)
						<tr>
						@if (!$employee->user->last_name)
							<td>
								<a class="text-light" href="/employees/{{ $employee->id }}/">{{ \Illuminate\Support\Str::title($employee->user->first_name) }} {{ \Illuminate\Support\Str::title($employee->user->maiden_name) }}</a>
							@auth
							@if ($user->is_staff == 'True')
								(<i class="fa fa-magic"></i> <a href="/schedules/employees/{{ $employee->id }}/">Edit</a>)
							@endif
							@endauth
							</td>
						@else
						<td><a class="text-light" href="/employees/{{ $employee->id }}/">{{ $employee->user->last_name }}, {{ \Illuminate\Support\Str::title($employee->user->first_name) }} {{ \Illuminate\Support\Str::title($employee->user->maiden_name) }}</a>
							@auth
							@if ($user->is_staff == 'True')
								(<i class="fa fa-magic"></i> <a href="/schedules/employees/{{ $employee->id }}/">Edit</a>)
							@endif
							@endauth
							</td>
						@endif
						@for ($day_adder = 0; $day_adder < 7; $day_adder++)
							@if ($employee->schedule->count() > 0)
								@if ($employee->schedule->firstWhere('date_of_shift', '=', \Carbon\Carbon::parse($start_date)->addDays($day_adder)->format('Y-m-d')) )
									<td><strong>{{ $employee->schedule->where('date_of_shift', '=', \Carbon\Carbon::parse($start_date)->addDays($day_adder)->format('Y-m-d'))->last()->time_of_shift }}</strong></td>
								@else
									<td><i>REST DAY</i></td>
								@endif
							@endif
						@endfor
						</tr>
					@endforeach
					</tbody>
				</table>
			@elseif ($employees->count() == 0 && $user->is_staff == 'True')
				<p>No employees found. <a href="{{ route('employees.create') }}">Wanna create one now?</a></p>
			@elseif ($employees->count() == 0 && $user->is_staff == 'False')
				<p>No employees found.</p>
			@endif
			</div>
		</div>
	</div>

<script>
	$('#start_of_week').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
		disableDaysOfWeek: [0, 1, 2, 3, 4, 5],
	});
</script>
@endsection
