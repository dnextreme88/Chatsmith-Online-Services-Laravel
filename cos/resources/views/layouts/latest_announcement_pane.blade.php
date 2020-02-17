<h1>Announcements!</h1>
<p class="text-left">Posted by <a href="announcements/user/{{ $latest_announcement->user->username }}">{{ $latest_announcement->user->username }}</a> on <strong>{{ \Carbon\Carbon::parse($latest_announcement->created_at)->format('F j, Y g:i:s A') }}</strong></p>
<h3>{{ $latest_announcement->title }}</h3>
<p id="announcement-pane-description">{{ $latest_announcement->description }}</p>