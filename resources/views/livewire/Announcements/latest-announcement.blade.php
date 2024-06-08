@push('styles')
    <link href="{{ asset('css/Components/Announcements/index.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/Announcements/index.js') }}"></script>
@endpush

<div class="flex w-full py-2">
    <div class="w-1/4 px-2 m-auto">
        <img src="{{ $latest_announcement->user->image }}" class="d-block m-auto img-thumbnail img-responsive avatar-thumbnail-small" alt="User image" />
    </div>

    <div class="w-3/4 px-4 py-2 text-white relative speech-bubble">
        <h1>Latest Announcement!</h1>
        <p class="text-left">Posted by <a wire:navigate href="{{ route('announcements.show_by_username', ['username' => $latest_announcement->user->username]) }}" class="links">{{ $latest_announcement->user->username }}</a> on <strong>{{ \Carbon\Carbon::parse($latest_announcement->created_at)->format('F j, Y g:i:s A') }}</strong></p>
        <h3>{{ $latest_announcement->title }}</h3>

        @include('Components.Announcements.includes.description', ['announcement_description' => $latest_announcement->description])

        <p class="text-right"><a wire:navigate href="{{ route('announcements.index') }}" class="links">View all announcements...</a></p>
    </div>
</div>
