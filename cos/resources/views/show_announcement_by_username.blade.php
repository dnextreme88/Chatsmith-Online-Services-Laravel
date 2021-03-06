@extends($layout)

@section('title')
All Announcements of {{ $user_by_username->username }}
@endsection

@section('content')
<div class="container">
	<div class="row">
	@guest
		<div class="col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('announcements.index') }}">Announcements</a></li>
				<li class="breadcrumb-item">Showing all announcements of {{ $user_by_username->username }}</li>
			</ol>
		</div>
	@else
		@if ($user->is_staff == 'False')
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('announcements.index') }}">Announcements</a></li>
					<li class="breadcrumb-item">Showing all announcements of {{ $user_by_username->username }}</li>
				</ol>
			</div>
		@endif
	@endguest
		<div class="col-md-12 text-center">
			<h1 class="text-center">Showing all announcements of {{ $user_by_username->username }}</h1>
		</div>
		@foreach ($announcements as $announcement)
			<div class="col-md-12 alert alert-info alert-block">
				<h1>Title: <a href="/announcements/{{ $announcement->id }}/">{{ $announcement->title }}</a></h1>
				<p class="text-left">Posted by <strong>{{ $announcement->user->username }}</strong> on <strong>{{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y g:i:s A') }}</strong></p>
				<p class="announcement-pane-description">
					{{ \Illuminate\Support\Str::limit($announcement->description, 255, '.....') }}
					@if (strlen($announcement->description) > 255)
						<a href="/announcements/{{ $announcement->id }}/">Read More...</a>
					@endif
				</p>
			</div>
		@endforeach
		{{ $announcements->links() }}
	</div>
</div>
@endsection