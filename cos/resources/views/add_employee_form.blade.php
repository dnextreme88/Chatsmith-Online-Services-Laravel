@extends('layouts.app')

@section('title')
Chatsmith Online Services Employees - Add Employee Form
@endsection

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">Add Employee Form</div>

		<div class="card-body">
		@if (session('success'))
			<div class="alert alert-success alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session('success') }}
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
							<option value="{{ $user->id }}">{{ $user->name }}</option>
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
				<!-- First name -->
				<div class="form-group row">
					<label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

					<div class="col-md-6">
						<input id="first_name" class="form-control input-lg" type="text" name="first_name">
					</div>
				</div>
				<!-- Maiden name -->
				<div class="form-group row">
					<label for="maiden_name" class="col-md-4 col-form-label text-md-right">Maiden Name</label>

					<div class="col-md-6">
						<input id="maiden_name" class="form-control input-lg" type="text" name="maiden_name">
					</div>
				</div>
				<!-- Last name -->
				<div class="form-group row">
					<label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

					<div class="col-md-6">
						<input id="last_name" class="form-control input-lg" type="text" name="last_name">
					</div>
				</div>
				<!-- Role -->
				<div class="form-group row">
					<label for="employee_role" class="col-md-4 col-form-label text-md-right">Role</label>

					<div class="col-md-6">
						<input id="employee_role" class="form-control input-lg" type="text" name="employee_role">
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
