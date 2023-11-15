@extends($layout)

@section('title')
	@auth
		@if ($user->is_staff == 'True')
			Manage Employees
		@else
			Employees
		@endif
	@endauth
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
	@if ($user->is_staff == 'False')
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
				<li class="breadcrumb-item">Employees</li>
			</ol>
		</div>
	@endif
		<div class="col-md-12">
		@if (session('success'))
			<div class="alert alert-success alert-block" role="alert">
				<button type="button" class="close" data-bs-dismiss="alert">&times;</button>
				{{ session('success') }}
			</div>
		@elseif (isset($search_success_message))
			<div class="alert alert-success alert-block" role="alert">
				<button type="button" class="close" data-bs-dismiss="alert">&times;</button>
				{{ $search_success_message }}
			</div>
		@elseif ($errors->any())
			<div class="alert alert-danger" role="alert">
				<p>Search Employee Errors</p>
				<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
				</ul>
			</div>
		@endif
			<!-- Search employees form -->
			<form id="search-employees-form" class="form-inline" action="{{ route('search_employees') }}" method="GET">
				<div class="form-group my-2">
					<input id="search_employees_query" class="form-control" type="text" name="search_employees_query" placeholder="Search employees..." required>
				</div>
				<div class="form-group my-2">
					<label for="show_number_of_results" class="m-2">Show</label>
					<select id="show_number_of_results" class="form-control" name="show_number_of_results">
					@foreach ($show_number_of_results_choices as $show_number_of_results)
						<option value="{{ $show_number_of_results }}">{{ $show_number_of_results }}</option>
					@endforeach
					</select>
					<label for="show_number_of_results" class="m-2">results</label>
				</div>
				<div class="form-group m-2">
					<button class="btn btn-secondary" type="submit" name="submit"><i class="fa fa-search"></i></button>
				</div>
			</form>
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
						<td>
						@if ($employee->date_tenure == '')
							---
						@else
							{{ \Carbon\Carbon::parse($employee->date_tenure)->format('F j, Y') }}
						@endif
						</td>
						<td class="text-center">
						@auth
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
						@endauth
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
	</div>
</div>
@endsection
