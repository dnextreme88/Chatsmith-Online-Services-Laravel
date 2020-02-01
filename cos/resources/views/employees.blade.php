@extends('layouts.app')

@section('title')
Chatsmith Online Services Employees
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<!-- Left Side -->
		<div class="col-md-10">
		@if ($employees->count() > 0)
			<table class="table table-bordered table-responsive">
				<thead>
					<th>ID</th>
					<th>Employee Number</th>
					<th>Username</th> <!-- Get Username from Foreign Key User -->
					<th>Email</th> <!-- Get Email from Foreign Key User -->
					<th>First Name</th>
					<th>Maiden Name</th>
					<th>Last Name</th>
					<th>Role</th>
					<th>Date of Tenure</th>
					<th>Is Active?</th>
					@if ($user->is_staff == 'True')
						<th width="25%">Actions</th>
					@endif
				</thead>
				<tbody>
					@foreach ($employees as $employee)
					<tr>
						<td>{{ $employee->id }}</td>
						<td>{{ $employee->employee_number }}</td>
						<td>{{ $employee->user->username }}</td>
						<td>{{ $employee->user->email }}</td>
						<td>{{ $employee->first_name }}</td>
						<td>{{ $employee->maiden_name }}</td>
						<td>{{ $employee->last_name }}</td>
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
								<li class="list-inline-item"><a href="/employees/{{ $employee->id }}/"><i class="fa fa-eye"></i> View</a></li>
								<li class="list-inline-item"><i class="fa fa-magic"></i> Edit</li>
								<li class="list-inline-item"><i class="fa fa-trash"></i> Delete</li>
							</ul></td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $employees->links() }}
		@else
			<p>No employees found. <a href="employees/create/">Wanna create one now?</a></p>
		@endif
		</div>
		<!-- Right Side / Navigation -->
		@if ($user->is_staff == 'True')
			<div class="col-md-2">
	            <div class="card">
	                <div class="card-header">Admin Panel</div>
	                <div class="card-body">
	                    <ul>
	                    	<li><a href="/employees/create/">Add Employee</a></li>
	                    	<li>Admin Logs</li> <!-- Still thinking about it. Create logs table -->
	                    </ul>
	                </div>
	            </div>
	        </div>
        @endif
	</div>
</div>
@endsection