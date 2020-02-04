@extends('layouts.app')

@section('title')
Chatsmith Online Services - Announcement # {{ $current_announcement->id }}
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 alert alert-info alert-block">
			<h1>Title: {{ $current_announcement->title }}</h1>
			<p class="text-left">Posted by <a class="alert-link" href="/announcements/user/{{ $current_announcement->user->username }}">{{ $current_announcement->user->username }}</a> on <strong>{{ \Carbon\Carbon::parse($current_announcement->created_at)->format('F j, Y g:i:s A') }}</strong></p>
			<p class="announcement-pane-description">{{ $current_announcement->description }}</p>
		</div>
		<!-- Previous/Next pagination links -->
		<div class="col-md-12">
			<ul class="pagination justify-content-center" id="announcement-pagination-list">
			@if ($previous_announcement)
				<li class="page-item"><a class="page-link" href="/announcements/{{ $previous_announcement->id }}">&lt; &lt; Previous announcement</a></li>
			@endif
			@if ($next_announcement)
				<li class="page-item"><a class="page-link" href="/announcements/{{ $next_announcement->id }}">Next announcement &gt; &gt;</a></li>
			@endif
			</ul>
		</div>
		@if ($user->is_staff == 'True')
			<div class="col-md-12">
				<dl class="row">
					<dt class="col-sm-6">Actions</dt>
					<dd class="col-sm-3"><i class="fa fa-magic"></i> <a href="/announcements/{{ $current_announcement->id }}/edit/">Edit</a></dd>
					<dd class="col-sm-3">
						<form action="/announcements/{{ $current_announcement->id }}" method="POST">
							@csrf
							@method('DELETE')
							<i class="fa fa-trash"></i> <input class="delete-announcement-button" type="submit" name="submit" value="Delete">
						</form>
					</dd>
				</dl>
			</div>
		@endif
	</div>
</div>
@endsection