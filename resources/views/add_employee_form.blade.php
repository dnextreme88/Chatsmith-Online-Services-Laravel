@extends('layouts.admin_panel')

@section('title')
Add Employee Form
@endsection

@section('content')
<div class="container">
	<x-custom.breadcrumbs :nav_links="['Employees' => route('employees.index')]">Create Employee</x-custom.breadcrumbs>

	<div class="card">
		<x-custom.card-header-title>{{ __('Add Employee Form') }}</x-card-header-title>

		<div class="card-body">
		@if (session('success'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				{{ session('success') }} You may go back and see <a href="{{ route('employees.index') }}" class="alert-link">all the employees</a>.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif
			<form action="{{ route('employees.store') }}" method="POST">
				@csrf
				<!-- User (Foreign key) -->
				<div class="form-group row">
					<label for="user_id" class="col-md-4 col-form-label text-md-right">User</label>

					<div class="col-md-6">
						<select id="user_id" class="form-control" name="user_id">
						@foreach ($pending_users as $user)
							<option value="{{ $user['id'] }}">{{ $user['first_name'] }} {{ $user['maiden_name'] }} {{ $user['last_name'] }}</option>
						@endforeach
						</select>
					</div>
				</div>
				<!-- Employee number -->
				<div class="form-group row">
					<label for="employee_number" class="col-md-4 col-form-label text-md-right">Employee Number</label>

					<div class="col-md-6">
						<input id="employee_number" class="form-control input-lg" type="text" name="employee_number">
					</div>
				</div>
				<!-- Employee type -->
				<div class="form-group row">
					<label for="employee_type" class="col-md-4 col-form-label text-md-right">Employee type</label>

					<div class="col-md-6">
						<select id="employee_type" class="form-control" name="employee_type">
						@foreach ($employee_type_choices as $employee_type)
							<option value="{{ $employee_type }}">{{ $employee_type }}</option>
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
							<option value="{{ $designation }}">{{ $designation }}</option>
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
							<option value="{{ $role }}">{{ $role }}</option>
						@endforeach
						</select>
					</div>
				</div>
				<!-- Date of Tenure -->
				<div class="form-group row">
					<label for="date_tenure" class="col-md-4 col-form-label text-md-right">Date of Tenure</label>

					<div class="col-md-6">
						<input id="date_tenure" class="form-control input-lg" type="text" name="date_tenure">
						<small class="form-text text-muted">Format: YEAR-MONTH-DAY eg. 2020-02-28</small>
					</div>
				</div>
				<div class="form-group row mb-0">
					<div class="col-md-6 offset-md-4">
						<input class="btn btn-primary" type="submit" name="submit" value="Add Employee">
					</div>
				</div>
			</form><br />
		@if($errors->any())
			<div class="alert alert-danger" role="alert">
				<p>Add Employee Errors</p>
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
