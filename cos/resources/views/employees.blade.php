@extends('layouts.app')

@section('title')
Chatsmith Online Services - Employees
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
				@if ($user->is_staff == 'True')
					<li class="breadcrumb-item"><a href="{{ route('admin_panel_home') }}">Admin Panel Home</a></li>
				@endif
				<li class="breadcrumb-item">Employees</li>
			</ol>
		</div>
		<!-- Left Side -->
		<div class="col-md-9">
		@if (session('success'))
			<div class="alert alert-success alert-block" role="alert">
				<button type="button" class="close" data-dismiss="alert">x</button>
				{{ session('success') }}
			</div>
		@endif
		@if ($employees->count() > 0)
			<table class="table table-bordered table-responsive">
				<thead>
					<th>Employee Number</th>
					<th>Username</th> <!-- Get Username from Foreign Key User -->
					<th>Email</th> <!-- Get Email from Foreign Key User -->
					<th>Name</th>
					<th>Type</th>
					<th>Designation</th>
					<th>Role</th>
					<th>Date of Tenure</th>
					<th>Is Active?</th>
					@if ($user->is_staff == 'True')
						<th width="30%">Actions</th>
					@endif
				</thead>
				<tbody>
				@foreach ($employees as $employee)
					<tr>
						<td>{{ $employee->employee_number }}</td>
						<td>{{ $employee->user->username }}</td>
						<td>{{ $employee->user->email }}</td>
						<td>{{ $employee->user->first_name }} {{ $employee->user->maiden_name }} {{ $employee->user->last_name }}</td>
						<td>{{ $employee->employee_type }}</td>
						<td>{{ $employee->designation }}</td>
						<td>{{ $employee->role }}</td>
						<td>{{ $employee->date_of_tenure }}</td>
						<td class="text-center">
						@if ($employee->is_active == 'True')
							<i class="text-success fa fa-check-circle"></i>
						@else
							<i class="text-danger fa fa-times-circle"></i>
						@endif
						</td>
						@if ($user->is_staff == 'True')
							<td><ul class="list-inline">
									<li class="list-inline-item"><i class="fa fa-eye"></i> <a href="/employees/{{ $employee->id }}/">View</a></li>
									<li class="list-inline-item"><i class="fa fa-magic"></i> <a href="/employees/{{ $employee->id }}/edit/">Edit</a></li>
									<li class="list-inline-item">
										<form action="/employees/{{ $employee->id }}" method="POST">
											@csrf
											@method('DELETE')
											<i class="fa fa-trash"></i> <input class="delete-employee-button" type="submit" name="submit" value="Delete">
										</form>
									</li>
							</ul></td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $employees->links() }}
		@elseif ($employees->count() == 0 && $user->is_staff == 'True')
			<p>No employees found. <a href="{{ route('employees.create') }}">Wanna create one now?</a></p>
		@elseif ($employees->count() == 0 && $user->is_staff == 'False')
			<p>No employees found.</p>
		@endif
		</div>
		<!-- Right Side / Navigation -->
		@if ($user->is_staff == 'True')
            <div class="col-md-3">
                @include('layouts.admin_panel_right_nav')
            </div>
        @endif
	</div>
</div>
@endsection
