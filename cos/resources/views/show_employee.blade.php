@extends($layout)

@section('title')
Employee # {{ $employee->employee_number }}
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a></li>
				<li class="breadcrumb-item">{{ $employee->user->username }}</li>
			</ol>
		</div>
		<div class="card w-50 text-left mx-auto">
			<div class="card-header text-center">Viewing Employee Number {{ $employee->employee_number }}'s Profile</div>
			<!-- Profile Image (from User) -->
			<img src="/{{ $employee->user->image }}" class="card-img-top img-thumbnail img-responsive rounded-circle mx-auto d-block avatar-thumbnail-large" />
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
					<dt class="col-sm-6">Employee Name</dt>
					<dd class="col-sm-6">{{ $employee->user->first_name }} {{ $employee->user->maiden_name }} {{ $employee->user->last_name }}</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">Employee Type</dt>
					<dd class="col-sm-6">{{ $employee->employee_type }}</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">Office Designation</dt>
					<dd class="col-sm-6">{{ $employee->designation }}</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">Role</dt>
					<dd class="col-sm-6">{{ $employee->role }}</dd>
				</dl>
				<dl class="row">
					<dt class="col-sm-6">Date of Tenure</dt>
					<dd class="col-sm-6">
					@if ($employee->date_tenure == '')
						---
					@else
						{{ \Carbon\Carbon::parse($employee->date_tenure)->format('F j, Y') }}
					@endif
					</dd>
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
				@if ($user->is_staff == 'True')
					<dl class="row">
						<dt class="col-sm-6">Actions</dt>
						<dd class="col-sm-3"><i class="fa fa-magic"></i> <a href="/employees/{{ $employee->id }}/edit/">Edit</a></dd>
						<dd class="col-sm-3">
							<form action="/employees/{{ $employee->id }}" method="POST">
								@csrf
								@method('DELETE')
								<i class="fa fa-trash"></i> <input class="delete-employee-button" type="submit" name="submit" value="Delete">
							</form>
						</dd>
					</dl>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
