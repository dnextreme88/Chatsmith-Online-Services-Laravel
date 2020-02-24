@extends('layouts.app')

@section('title')
Chatsmith Online Services - Add Employee Form
@endsection

@section('content')
<div class="container">
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
			<li class="breadcrumb-item"><a href="/admin/">Admin Panel Home</a></li>
			<li class="breadcrumb-item"><a href="/employees/">Employees</a></li>
			<li class="breadcrumb-item">Create Employee</li>
		</ol>
	</div>
	<div class="card">
		<div class="card-header">Add Employee Form</div>

		<div class="card-body">
		@if (session('success'))
			<div class="alert alert-success alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session('success') }}. You may go back and see <a href="/employees/" class="alert-link">all the employees</a>.
			</div>
		@endif
			<form action="/employees/" method="POST">
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
@endsection
