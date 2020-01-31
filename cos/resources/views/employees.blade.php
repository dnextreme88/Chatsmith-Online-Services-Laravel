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
			<table class="table table-bordered">
				<thead>
					<th>ID</th>
					<th>Employee Number</th>
					<th>First Name</th>
					<th>Maiden Name</th>
					<th>Last Name</th>
					<th>Role</th>
					<th>Date of Tenure</th>
					<th>Is Active</th>
					<th>Actions</th>
				</thead>
				<tbody>
					@foreach ($employees as $employee)
					<tr>
						<td>{{ $employee->id }}</td>
						<td>{{ $employee->employee_number }}</td>
						<td>{{ $employee->first_name }}</td>
						<td>{{ $employee->maiden_name }}</td>
						<td>{{ $employee->last_name }}</td>
						<td>{{ $employee->role }}</td>
						<td>{{ $employee->date_of_tenure }}</td>
						<td class="text-center">
						@if ($employee->is_active == 'True')
							<i class="fa fa-check-circle"></i>
						@else
							<i class="fa fa-times-circle"></i>
						@endif
						</td>
						<td>View | Edit | Delete</td>
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
		<div class="col-md-2">
            <div class="card">
                <div class="card-header">Admin Panel</div>
                <div class="card-body">
                    <ul>
                    	<li><a href="employees/create/">Add Employee</a></li>
                    	<li>Admin Logs</li> <!-- Still thinking about it. Create logs table -->
                    </ul>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection