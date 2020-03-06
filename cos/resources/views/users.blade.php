@extends('layouts.admin_panel')

@section('title')
Manage Users
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
		@if (session('success'))
			<div class="alert alert-success alert-block" role="alert">
				<button type="button" class="close" data-dismiss="alert">x</button>
				{{ session('success') }}
			</div>
		@endif
		@if ($users->count() > 0)
			<table class="table table-bordered table-responsive">
				<thead>
					<th width="5%">ID</th>
					<th width="*">Username</th>
					<th width="*">Email</th> <!-- Get Email from Foreign Key User -->
					<th width="*">Name</th>
					<th width="*">Date Registered</th>
					<th width="5%">Is Staff?</th>
				</thead>
				<tbody>
					@foreach ($users as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td><img src="/{{ $user->profile_image }}" class="avatar-table" /> {{ $user->username }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->first_name }} {{ $user->maiden_name }} {{ $user->last_name }}</td>
						<td>{{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y')}}</td>
						<td class="text-center">
						@auth
							@if ($user->is_staff == 'True')
								<i class="text-success fa fa-check-circle"></i>
							@else
								<i class="text-danger fa fa-times-circle"></i>
							@endif
						@endauth
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $users->links() }}
		@else
			<p>No users found. <a href="users/create/">Wanna create one now?</a></p>
		@endif
		</div>
	</div>
</div>
@endsection
