@extends('layouts.admin_panel')

@section('title')
Home
@endsection

@section('content')
<div class="container-fluid">
	<div class="border p-4">
		<h1>Welcome to the Admin Panel, {{ $user->username }}!</h1>
		<p>Use the navigational links to browse through the different administrator tasks such as viewing all announcements, employees, users, adding employees etc.</p>
	</div>
	<div class="border px-2">
		<h1>Admin Logs</h1>
		@if ($admin_logs->count() > 0)
			<table class="table table-bordered table-responsive">
				<thead>
					<th>Log ID</th>
					<th>Username</th> <!-- Get Username from Foreign Key User -->
					<th>Description</th>
					<th>Timestamp</th>
				</thead>
				<tbody>
					@foreach ($admin_logs as $log)
					<tr>
						<td>{{ $log->id }}</td>
						<td>{{ $log->user->username }}</td>
						<td>{{ $log->description }}</td>
						<td>{{ $log->created_at }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		{{ $employees->links() }}
		@else
			<p>There are no logs at the moment.</p>
		@endif
	</div>
</div>
@endsection
