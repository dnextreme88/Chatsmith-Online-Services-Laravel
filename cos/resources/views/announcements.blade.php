@extends('layouts.app')

@section('title')
Chatsmith Online Services - Announcements
@endsection

@section('content')
<div class="container-fluid">
	<div class="row justify-content-center">
		<!-- Left Side -->
		<div class="col-md-9">
		@if (session('success'))
			<div class="alert alert-success alert-block" role="alert">
				<button type="button" class="close" data-dismiss="alert">x</button>
				{{ session('success') }}
			</div>
		@endif
		@if ($announcements->count() > 0)
			<table class="table table-bordered table-responsive">
				<thead>
					<th>ID</th>
					<th>Username</th> <!-- Get Username from Foreign Key User -->
					<th>Title</th>
					<th>Description</th>
					<th>Date Created</th>
					@if ($user->is_staff == 'True')
						<th width="30%">Actions</th>
					@endif
				</thead>
				<tbody>
					@foreach ($announcements as $announcement)
					<tr>
						<td>{{ $announcement->id }}</td>
						<td>{{ $announcement->user->username }}</td>
						<td>{{ $announcement->title }}</td>
						<td>{{ $announcement->description }}</td>
						<td>{{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y') }}</td>
						@if ($user->is_staff == 'True')
							<td><ul class="list-inline">
									<li class="list-inline-item"><i class="fa fa-eye"></i> <a href="/announcements/{{ $announcement->id }}/">View</a></li>
{{-- 									<li class="list-inline-item"><i class="fa fa-magic"></i> <a href="/announcements/{{ $announcement->id }}/edit/">Edit</a></li> --}}
									<li class="list-inline-item">
										<form action="/announcements/{{ $announcement->id }}" method="POST">
											@csrf
											@method('DELETE')
											<i class="fa fa-trash"></i> <input class="delete-announcement-button" type="submit" name="submit" value="Delete">
										</form>
									</li>
							</ul></td>
						@endif
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $announcements->links() }}
		@else
			<p>No announcements found. <a href="/announcements/create/">Wanna create one now?</a></p>
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
