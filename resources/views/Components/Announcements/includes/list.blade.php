<div>
    @foreach ($announcements as $announcement)
        <div class="mb-2">
            <h1>{{ $announcement->title }}</h1>
            <p class="text-gray-400">Posted by <a wire:navigate href="{{ route('announcements.show_by_username', ['username' => $announcement->user->username]) }}" class="links">{{ $announcement->user->username }}</a> on <small>{{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y h:i:s A') }}</small></p>
            <hr>

            @include('Components.Announcements.includes.description', ['announcement_description' => $announcement->description])

            @auth
                @if ($user->is_staff == 'True')
                    <ul class="pl-0 flex gap-2">
                        <li><i class="fa fa-eye"></i> <a wire:navigate href="{{ \App\Filament\Resources\AnnouncementResource::getUrl('view', ['record' => $announcement->id]) }}" class="links">View</a></li>

                        @if ($announcement->user_id == auth()->id())
                            <li><i class="fa fa-magic"></i> <a wire:navigate href="{{ \App\Filament\Resources\AnnouncementResource::getUrl('edit', ['record' => $announcement->id]) }}" class="links">Edit</a></li>
                        @endif
                    </ul>
                @endif
            @endauth
        </div>
    @endforeach
</div>
