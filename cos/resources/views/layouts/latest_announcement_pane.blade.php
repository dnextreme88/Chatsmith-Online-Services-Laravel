<h1>Announcements!</h1>
<p class="text-left">Posted by <strong>{{ $latest_announcement->user->username }}</strong> on <strong>{{ \Carbon\Carbon::parse($latest_announcement->created_at)->format('F j, Y g:i:s') }}</strong></p>
<h3>{{ $latest_announcement->title }}</h3>
<p class="announcement-pane-description">{{ $latest_announcement->description }}</p>