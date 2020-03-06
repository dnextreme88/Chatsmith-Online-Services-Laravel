@extends('layouts.admin_panel')

@section('title')
Edit Employee Form
@endsection

@section('content')
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
			<li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
			<li class="breadcrumb-item">Employee: {{ $employee->id }}</li>
		</ol>
	</div>
	<div class="card">
		<div class="card-header">Edit Employee Form</div>

		<div class="card-body">
		@if (session('success'))
			<div class="alert alert-success alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session('success') }} You may go back and see <a href="{{ route('employees.index') }}" class="alert-link">all the employees</a>.
			</div>
		@endif
			<form action="/employees/{{ $employee->id }}/" method="POST">
				@csrf
				@method('PUT')
				<!-- User (Foreign key) -->
				<div class="form-group row">
					<label for="user_id" class="col-md-4 col-form-label text-md-right">User</label>

					<div class="col-md-6">
						<select id="user_id" class="form-control" name="user_id">
						@foreach ($users as $user)
							@if ($user->id == $employee->user->id)
								<option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->maiden_name }} {{ $user->last_name }}</option>
							@else
								<option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->maiden_name }} {{ $user->last_name }}</option>
							@endif
						@endforeach
						</select>
					</div>
				</div>
				<!-- Employee number -->
				<div class="form-group row">
					<label for="employee_number" class="col-md-4 col-form-label text-md-right">Employee Number</label>

					<div class="col-md-6">
						<input id="employee_number" class="form-control input-lg" type="text" name="employee_number" value="{{ $employee->employee_number }}">
					</div>
				</div>
				<!-- Employee type -->
				<div class="form-group row">
					<label for="employee_type" class="col-md-4 col-form-label text-md-right">Employee Type</label>

					<div class="col-md-6">
						<select id="employee_type" class="form-control" name="employee_type">
						@foreach ($employee_type_choices as $employee_type)
							@if ($employee_type == $employee->employee_type)
								<option value="{{ $employee_type }}" selected>{{ $employee_type }}</option>
							@else
								<option value="{{ $employee_type }}">{{ $employee_type }}</option>
							@endif
						@endforeach
						</select>
					</div>
				</div>
				<!-- Designation -->
				<div class="form-group row">
					<label for="designation" class="col-md-4 col-form-label text-md-right">Office Designation</label>

					<div class="col-md-6">
						<select id="designation" class="form-control" name="designation">
						@foreach ($designation_choices as $designation)
							@if ($designation == $employee->designation)
								<option value="{{ $designation }}" selected>{{ $designation }}</option>
							@else
								<option value="{{ $designation }}">{{ $designation }}</option>
							@endif
						@endforeach
						</select>
					</div>
				</div>
				<!-- Role -->
				<div class="form-group row">
					<label for="employee_role" class="col-md-4 col-form-label text-md-right">Role</label>

					<div class="col-md-6">
						<select id="employee_role" class="form-control" name="employee_role">
						@foreach ($role_choices as $role)
							@if ($role == $employee->role)
								<option value="{{ $role }}" selected>{{ $role }}</option>
							@else
								<option value="{{ $role }}">{{ $role }}</option>
							@endif
						@endforeach
						</select>
					</div>
				</div>
				<!-- Date of Tenure -->
				<div class="form-group row">
					<label for="date_tenure" class="col-md-4 col-form-label text-md-right">Date of Tenure</label>

					<div class="col-md-6">
						<input id="date_tenure" class="form-control input-lg" type="text" name="date_tenure" value="{{ $employee->date_tenure }}">
						<small class="form-text text-muted">Format: YEAR-MONTH-DAY eg. 2020-02-28</small>
					</div>
				</div>
				<!-- Is active -->
				<div class="form-group row">
					<label for="is_active" class="col-md-4 col-form-label text-md-right">Is active</label>

					<div class="col-md-6">
						<select id="is_active" class="form-control" name="is_active">
							@foreach ($is_active_choices as $is_active)
								@if ($is_active_choices == $employee->is_active)
									<option value="{{ $is_active }}" selected>{{ $is_active }}</option>
								@else
									<option value="{{ $is_active }}">{{ $is_active }}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row mb-0">
					<div class="col-md-6 offset-md-4">
						<input class="btn btn-primary" type="submit" name="submit" value="Edit Employee">
					</div>
				</div>
			</form><br />
		@if($errors->any())
			<div class="alert alert-danger" role="alert">
				<p>Edit Employee Errors</p>
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
	$('#date_tenure').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd'
	});
</script>
@endsection
