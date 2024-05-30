<div class="container py-2">
    <div class="row">
        <div class="col-md-2 m-auto">
            <img src="{{ $latest_announcement->user->image }}" class="d-block m-auto img-thumbnail img-responsive avatar-thumbnail-small" alt="User image" />
        </div>

        <div class="col-md-10 text-white position-relative speech-bubble">
            <h1>Latest Announcement!</h1>
            <p class="text-left">Posted by <a href="announcements/user/{{ $latest_announcement->user->username }}" class="links">{{ $latest_announcement->user->username }}</a> on <strong>{{ \Carbon\Carbon::parse($latest_announcement->created_at)->format('F j, Y g:i:s A') }}</strong></p>
            <h3>{{ $latest_announcement->title }}</h3>

            @include('Components.Announcements.includes.description', ['announcement_description' => $latest_announcement->description])

            <p class="text-right"><a href="{{ route('announcements.index') }}" class="links">View all announcements...</a></p>
        </div>
    </div>
</div>
