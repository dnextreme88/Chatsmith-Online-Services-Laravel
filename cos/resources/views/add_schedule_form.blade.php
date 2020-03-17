@extends('layouts.admin_panel')

@section('title')
Add Schedule Form
@endsection

@section('content')
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
			<li class="breadcrumb-item"><a href="{{ route('schedules.index') }}">Schedules</a></li>
			<li class="breadcrumb-item">Create Schedule</li>
		</ol>
	</div>
	<div class="card">
		<div class="card-header">Add Schedule Form</div>

		<div class="card-body">
		@if (session('success'))
			<div class="alert alert-success alert-block" role="alert">
				<button type="button" class="close" data-dismiss="alert">x</button>
				{{ session('success') }} You may go back and see <a href="{{ route('schedules.index') }}" class="alert-link">all the schedules</a>.
			</div>
		@endif
			<form action="{{ route('schedules.store') }}" method="POST">
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
				<!-- Time of Shift -->
				<div class="form-group row">
					<label for="time_of_shift" class="col-md-4 col-form-label text-md-right">Time of Shift</label>

					<div class="col-md-6">
						<select id="time_of_shift" class="form-control" name="time_of_shift">
						@foreach ($time_of_shift_choices as $time_of_shift)
							<option value="{{ $time_of_shift }}">{{ $time_of_shift }}</option>
						@endforeach
						</select>
					</div>
				</div>
				<!-- Date of Shift -->
				<div class="form-group row">
					<label for="date_of_shift" class="col-md-4 col-form-label text-md-right">Date of Shift</label>

					<div class="col-md-6">
						<input id="date_of_shift" class="form-control input-lg" type="text" name="date_of_shift">
						<small class="form-text text-muted">Format: YEAR-MONTH-DAY eg. 2020-02-28</small>
					</div>
				</div>
				<div class="form-group row mb-0">
					<div class="col-md-6 offset-md-4">
						<input class="btn btn-primary" type="submit" name="submit" value="Add Schedule">
					</div>
				</div>
			</form><br />
		@if($errors->any())
			<div class="alert alert-danger" role="alert">
				<p>Add Schedule Errors</p>
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
	$('#date_of_shift').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd'
	});
</script>
@endsection
