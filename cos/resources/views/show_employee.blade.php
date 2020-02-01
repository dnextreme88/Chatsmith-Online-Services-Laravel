@extends('layouts.app')

@section('title')
Chatsmith Online Services - Employee # {{ $employee->employee_number }}
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 offset-md-4">
			<h1>Viewing Employee Number {{ $employee->employee_number }}'s Data</h1>
		</div>
	</div>
	<!-- Employee ID -->
	<div class="row">
		<label for="employee_id" class="col-md-6 text-md-right"><strong>ID</strong></label>

		<div class="col-md-6" id="employee_id">{{ $employee->id }}</div>
	</div>
	<!-- User (Foreign Key) -->
	<div class="row">
		<label for="username" class="col-md-6 text-md-right"><strong>Username</strong></label>

		<div class="col-md-6" id="username">{{ $employee->user->username}}</div>
	</div>
	<!-- Employee number -->
	<div class="row">
		<label for="employee_number" class="col-md-6 text-md-right"><strong>Employee Number</strong></label>

		<div class="col-md-6" id="employee_number">{{ $employee->employee_number }}</div>
	</div>
	<!-- First name -->
	<div class="row">
		<label for="first_name" class="col-md-6 text-md-right"><strong>First Name</strong></label>

		<div class="col-md-6" id="first_name">{{ $employee->first_name }}</div>
	</div>
	<!-- Maiden name -->
	<div class="row">
		<label for="maiden_name" class="col-md-6 text-md-right"><strong>Maiden Name</strong></label>

		<div class="col-md-6" id="maiden_name">{{ $employee->maiden_name }}</div>
	</div>
	<!-- Last name -->
	<div class="row">
		<label for="last_name" class="col-md-6 text-md-right"><strong>Last Name</strong></label>

		<div class="col-md-6" id="last_name">{{ $employee->last_name }}</div>
	</div>
	<!-- Role -->
	<div class="row">
		<label for="role" class="col-md-6 text-md-right"><strong>Role</strong></label>

		<div class="col-md-6" id="role">{{ $employee->role }}</div>
	</div>
	<!-- Date of tenure -->
	<div class="row">
		<label for="date_of_tenure" class="col-md-6 text-md-right"><strong>Date of Tenure</strong></label>

		<div class="col-md-6" id="date_of_tenure">{{ $employee->date_of_tenure }}</div>
	</div>
	<!-- Is active -->
	<div class="row">
		<label for="is_active" class="col-md-6 text-md-right"><strong>Is Active</strong></label>

		<div class="col-md-6" id="is_active">
		@if ($employee->is_active == 'True')
			<i class="text-success fa fa-check-circle"></i>
		@else
			<i class="text-danger fa fa-times-circle"></i>
		@endif
		</div>
	</div>
	<!-- Actions (Edit / Delete) -->
	<div class="row">
		<label for="user_id" class="col-md-6 text-md-right"><strong>Actions</strong></label>

		<div class="col-md-6">
			<i class="fa fa-magic"></i> Edit | <i class="fa fa-trash"></i> Delete
		</div>
	</div>
</div>
@endsection