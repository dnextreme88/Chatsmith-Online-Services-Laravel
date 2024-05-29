@extends('layouts.admin_panel')

@section('title')
Add Task Form
@endsection

@section('content')
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
			<li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
			<li class="breadcrumb-item">Create Task</li>
		</ol>
	</div>
	<div class="card">
		<div class="card-header">Add Task Form</div>

		<div class="card-body">
		@if (session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session('success') }} You may go back and see <a href="{{ route('tasks.index') }}" class="alert-link">all the tasks</a>.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
			<form action="{{ route('tasks.store') }}" method="POST">
				@csrf
				<!-- User (Foreign key) -->
				<div class="form-group row">
					<label for="user_id" class="col-md-4 col-form-label text-md-right">User</label>

					<div class="col-md-6">
						<select id="user_id" class="form-control" name="user_id">
						@foreach ($users as $user)
							<option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->maiden_name }} {{ $user->last_name }}</option>
						@endforeach
						</select>
					</div>
				</div>
				<!-- Time Range (Foreign key) -->
				<div class="form-group row">
					<label for="time_range" class="col-md-4 col-form-label text-md-right">Time Range</label>

					<div class="col-md-6">
						<select id="time_range" class="form-control" name="time_range">
						@foreach ($time_ranges as $time_range)
							<option value="{{ $time_range->id }}">{{ $time_range->time_range }}</option>
						@endforeach
						</select>
					</div>
				</div>
				<!-- Task -->
				<div class="form-group row">
					<label for="task_name" class="col-md-4 col-form-label text-md-right">Task for this Employee</label>

					<div class="col-md-6">
						<select id="task_name" class="form-control" name="task_name">
						@foreach ($task_name_choices as $task_name)
							<option value="{{ $task_name }}">{{ $task_name }}</option>
						@endforeach
						</select>
					</div>
				</div>
				<!-- Task Date -->
				<div class="form-group row">
					<label for="task_date" class="col-md-4 col-form-label text-md-right">Task Date</label>

					<div class="col-md-6">
						<input id="task_date" class="form-control input-lg" type="text" name="task_date">
						<small class="form-text text-muted">Format: YEAR-MONTH-DAY eg. 2020-03-19</small>
					</div>
				</div>
				<div class="form-group row mb-0">
					<div class="col-md-6 offset-md-4">
						<input class="btn btn-primary" type="submit" name="submit" value="Add Task">
					</div>
				</div>
			</form><br />
		@if($errors->any())
			<div class="alert alert-danger" role="alert">
				<p>Add Task Errors</p>
				<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
				</ul>
			</div>
		@endif
		</div>
	</div>
</div>

<script>
	$('#task_date').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd'
	});
</script>
@endsection
