@extends('layouts.app')

@section('title')
Chatsmith Online Services - Employee # {{ $employee->employee_number }}
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="card w-50 text-left mx-auto">
			<div class="card-header text-center">Viewing Employee Number {{ $employee->employee_number }}'s Data</div>
			<!-- Profile Image (from User) -->
			@if ($employee->user->profile_image == '') <!-- Display a text when user doesn't have any profile image. -->
				<p class="text-center">This employee does not have a profile image set.</p>
			@else <!-- Get current image when the view is loaded -->
				<img src="/{{ $employee->user->image }}" class="card-img-top img-thumbnail img-responsive mx-auto d-block avatar-thumbnail-large" />
			@endif
			<div class="card-body">
				<dl class="row">
					<dt class="col-sm-6">Employee ID</dt>
					<dd class="col-sm-6">{{ $employee->id }}</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">User</dt>
					<dd class="col-sm-6">{{ $employee->user->username }}</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">Employee Number</dt>
					<dd class="col-sm-6">{{ $employee->employee_number }}</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">First Name</dt>
					<dd class="col-sm-6">{{ $employee->first_name }}</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">Maiden Name</dt>
					<dd class="col-sm-6">{{ $employee->maiden_name }}</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">Last Name</dt>
					<dd class="col-sm-6">{{ $employee->last_name }}</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">Role</dt>
					<dd class="col-sm-6">{{ $employee->role }}</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">Date of Tenure</dt>
					<dd class="col-sm-6">{{ $employee->date_of_tenure }}</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">Is active</dt>
					<dd class="col-sm-6">
					@if ($employee->is_active == 'True')
						<i class="text-success fa fa-check-circle"></i>
					@else
						<i class="text-danger fa fa-times-circle"></i>
					@endif
					</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">Actions</dt>
					<dd class="col-sm-6"><i class="fa fa-magic"></i> <a href="/employees/{{ $employee->id }}/edit/">Edit</a> | <i class="fa fa-trash"></i> Delete</dd>
				</dl>
			</div>
		</div>
	</div>
</div>
@endsection