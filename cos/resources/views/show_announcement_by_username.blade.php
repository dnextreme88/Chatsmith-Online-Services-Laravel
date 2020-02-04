@extends('layouts.app')

@section('title')
Show Announcements of {{ $user->username }}
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1 class="text-center">Showing all announcements of {{ $user->username }}</h1>
		</div>
		@foreach ($announcements as $announcement)
			<div class="col-md-12 alert alert-info alert-block">
				<h1>Title: <a href="/announcements/{{ $announcement->id }}/">{{ $announcement->title }}</a></h1>
				<p class="text-left">Posted by <strong>{{ $announcement->user->username }}</strong> on <strong>{{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y g:i:s A') }}</strong></p>
				<p class="announcement-pane-description">{{ \Illuminate\Support\Str::limit($announcement->description, 255, $end='...') }}</p>
			</div>
		@endforeach
		{{ $announcements->links() }}
	</div>
</div>
@endsection