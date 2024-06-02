@extends($layout)

@section('title')
	@guest
		Tasks
	@else
		@auth
			@if ($user->is_staff == 'True')
				Manage Tasks
			@else
				Tasks
			@endif
		@endauth
	@endguest
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<x-custom.breadcrumbs :nav_links="[]">Tasks</x-custom.breadcrumbs>

		<div class="col-md-12">
			<h2 class="text-center">COS Tasks 2020</h2>
			<form action="{{ route('view_task_by_day') }}" method="POST">
			@csrf
			<!-- Daily task date picker -->
				<div class="form-group row p-2">
					<label for="daily_task_date" class="col-md-4 col-form-label text-md-right">View tasks by day:</label>

					<div class="col-md-4">
						<input id="daily_task_date" class="form-control input-lg" type="text" name="daily_task_date" value="{{ $start_date }}">
					</div>
					<div class="col-md-4">
						<input class="btn btn-secondary" type="submit" name="submit" value="GO">
					</div>
				</div>
			</form>
		@if ($tasks->count() > 0)
			<h3>Daily Tasks for: {{ \Carbon\Carbon::parse($start_date)->format('F j, Y') }}</h3>
			<table class="table table-bordered table-responsive">
				<thead>
					<th>Employee</th>
					@foreach ($time_ranges as $time_range)
						<th>{{ $time_range->time_range }}</th>
					@endforeach
				</thead>
				<tbody>
				@foreach ($employees as $employee)
					<tr>
					@if (!$employee->user->last_name && $employee->task->count() > 0 && $employee->task->firstWhere('task_date', '=', \Carbon\Carbon::parse($start_date)->format('Y-m-d')))
						<td>
							<a class="text-light" href="/employees/{{ $employee->id }}/">{{ \Illuminate\Support\Str::title($employee->user->first_name) }} {{ \Illuminate\Support\Str::title($employee->user->maiden_name) }}</a>
						@auth
						@if ($user->is_staff == 'True')
							(<i class="fa fa-magic"></i> <a href="/tasks/employees/{{ $employee->id }}/">Edit</a>)
						@endif
						@endauth
						</td>
					@elseif ($employee->user->last_name && $employee->task->count() > 0 && $employee->task->firstWhere('task_date', '=', \Carbon\Carbon::parse($start_date)->format('Y-m-d')))
					<td><a class="text-light" href="/employees/{{ $employee->id }}/">{{ $employee->user->last_name }}, {{ \Illuminate\Support\Str::title($employee->user->first_name) }} {{ \Illuminate\Support\Str::title($employee->user->maiden_name) }}</a>
						@auth
						@if ($user->is_staff == 'True')
							(<i class="fa fa-magic"></i> <a href="/tasks/employees/{{ $employee->id }}/">Edit</a>)
						@endif
						@endauth
						</td>
					@endif
					@for ($day_adder = 1; $day_adder < 25; $day_adder++)
						@if ($employee->task->count() > 0 && $employee->task->firstWhere('task_date', '=', \Carbon\Carbon::parse($start_date)->format('Y-m-d')))
							@if ($employee->task->firstWhere('time_range_id', '=', $day_adder))
								<td><strong>{{ $employee->task->where('time_range_id', '=', $day_adder)->where('task_date', '=', $start_date)->last()->task_name ?? '---' }}</strong></td>
							@else
								<td><i>---</i></td>
							@endif
						@endif
					@endfor
					</tr>
				@endforeach
				</tbody>
			</table>
			@elseif ($tasks->count() == 0)
				<p>No daily tasks plotted for {{ \Carbon\Carbon::parse($start_date)->format('F j, Y') }}.
				@auth
				@if ($user->is_staff == 'True')
					<a href="{{ route('tasks.create') }}">Wanna create one now?</a>
				@endif
				@endauth
				</p>
			@endif
		</div>
	</div>
</div>

<script>
	$('#daily_task_date').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd',
	});
</script>
@endsection
