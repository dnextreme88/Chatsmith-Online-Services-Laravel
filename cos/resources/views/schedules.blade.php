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
				<h3>Schedule for the work week: {{ \Carbon\Carbon::parse($start_date)->format('F j') }} - {{ \Carbon\Carbon::parse($end_date)->format('F j, Y') }}</h3>
				<table class="table table-bordered table-responsive">
					<thead>
						<th>Employee</th>
{{--						<!-- Format of date_of_shift field: format('Y-m-d') -->--}}
{{--							@for ($i = 0; $i < 7; $i++)--}}
{{--								<th>--}}
{{--									{{ \Carbon\Carbon::today()->addDays($i)->format('F j, Y') }}<br />--}}
{{--									{{ \Carbon\Carbon::today()->addDays($i)->format('D') }}--}}
{{--								</th>--}}
{{--							@endfor--}}
						<th width="12%" class="text-center">{{ $day1 }}<br />{{ $day1_day }}</th>
						<th width="12%" class="text-center">{{ $day2 }}<br />{{ $day2_day }}</th>
						<th width="12%" class="text-center">{{ $day3 }}<br />{{ $day3_day }}</th>
						<th width="12%" class="text-center">{{ $day4 }}<br />{{ $day4_day }}</th>
						<th width="12%" class="text-center">{{ $day5 }}<br />{{ $day5_day }}</th>
						<th width="12%" class="text-center">{{ $day6 }}<br />{{ $day6_day }}</th>
						<th width="12%" class="text-center">{{ $day7 }}<br />{{ $day7_day }}</th>
					</thead>
					<tbody>
					@foreach ($employees as $employee)
						<tr>
						@if (!$employee->user->last_name)
							<td>
								<a class="text-light" href="/employees/{{ $employee->id }}/">{{ $employee->user->first_name }} {{ $employee->user->maiden_name }}</a>
							@if ($user->is_staff == 'True')
								(<i class="fa fa-magic"></i> <a href="/schedules/employees/{{ $employee->id }}/">Edit</a>)
							@endif
							</td>
						@else
							<td><a class="text-light" href="/employees/{{ $employee->id }}/">{{ $employee->user->last_name }}, {{ $employee->user->first_name }} {{ $employee->user->maiden_name }}</a>
							@if ($user->is_staff == 'True')
								(<i class="fa fa-magic"></i> <a href="/schedules/employees/{{ $employee->id }}/">Edit</a>)
							@endif
							</td>
						@endif
						@for ($day_adder = 0; $day_adder < 7; $day_adder++)
							@if ($employee->schedule->count() > 0)
								@if ($employee->schedule->firstWhere('date_of_shift', '=', \Carbon\Carbon::today()->addDays($day_adder)->format('Y-m-d')) )
									<td><strong>{{ $employee->schedule->where('date_of_shift', '=', \Carbon\Carbon::today()->addDays($day_adder)->format('Y-m-d'))->last()->time_of_shift }}</strong></td>
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
{{--				<table class="table table-bordered table-responsive">--}}
{{--					<thead>--}}
{{--						<th>Schedule ID</th>--}}
{{--						<th>User ID</th>--}}
{{--						<th>Employee ID</th>--}}
{{--						<th>Time of Shift</th>--}}
{{--						<th>Date of Shift</th>--}}
{{--					</thead>--}}
{{--					<tbody>--}}
{{--					@foreach ($schedules as $schedule)--}}
{{--						<tr>--}}
{{--							<td>{{ $schedule->id }}</td>--}}
{{--							<td>{{ $schedule->user->id }}</td>--}}
{{--							<td>{{ $schedule->user->last_name }}, {{ $schedule->user->first_name }} {{ $schedule->user->maiden_name }} </td>--}}
{{--							<td>{{ $schedule->time_of_shift }}</td>--}}
{{--							<td>{{ $schedule->date_of_shift }}</td>--}}
{{--						</tr>--}}
{{--					@endforeach--}}
{{--					</tbody>--}}
{{--				</table>--}}
			</div>
		</div>
	</div>
@endsection
