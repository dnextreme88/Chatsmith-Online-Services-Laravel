<div>
    @foreach ($announcements as $announcement)
        <div class="mb-2">
            <h1><a wire:navigate href="{{ route('announcements.detail', ['id' => $announcement->id]) }}" class="links">{{ $announcement->title }}</a></h1>
            <p class="text-gray-400">Posted by <a wire:navigate href="{{ route('announcements.show_by_username', ['username' => $announcement->user->username]) }}" class="links">{{ $announcement->user->username }}</a> on <small>{{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y h:i:s A') }}</small></p>
            <hr>

            @include('Components.Announcements.includes.description', ['announcement_description' => $announcement->description])

            @auth
                @if ($user->is_staff == 'True' && $announcement->user_id == auth()->id())
                    <span><i class="fa fa-magic"></i> <a wire:navigate href="{{ \App\Filament\Resources\AnnouncementResource::getUrl('edit', ['record' => $announcement->id]) }}" class="links">Edit</a></span>
                @endif
            @endauth
        </div>
    @endforeach
</div>
