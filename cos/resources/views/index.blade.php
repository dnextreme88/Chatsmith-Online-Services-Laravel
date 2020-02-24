@extends('layouts.app')

@section('title')
Chatsmith Online Services
@endsection

@section('content')
<div class="container">
	<!-- Show announcements -->
	@foreach ($announcements as $announcement)
		<div class="mb-2">
			<h1>{{ $announcement->title }}</h1>
			<p class="text-muted">Posted by <a href="/announcements/user/{{ $announcement->user->username }}">{{ $announcement->user->username }}</a> on <small>{{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y h:i:s A') }}</small></p>
			<hr>
			<p>{{ $announcement->description}}</p>
		</div>
	@endforeach
</div>
@endsection