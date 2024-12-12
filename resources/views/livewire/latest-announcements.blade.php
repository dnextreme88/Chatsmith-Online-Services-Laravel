<div>
    <h3 class="flex items-center gap-2 text-3xl font-bold text-gray-600 dark:text-gray-300">
        <svg class="text-orange-800 dark:text-orange-200 fill-transparent size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
        </svg>

        <span>Latest Announcements</span>
    </h3>

    <div class="mx-3 my-6 space-y-4">
        @forelse ($announcements as $announcement)
            <div class="flex flex-col items-start justify-between w-full gap-0 sm:items-center sm:gap-y-4 sm:flex-row">
                <span class="font-bold text-gray-600 dark:text-gray-300 w-[200px]">{{ \Carbon\Carbon::parse($announcement->created_at)->format('M d, Y h:i:s A') }}</span>
                <a wire:navigate class="min-w-16 text-orange-800 dark:text-orange-200 hover:underline sm:truncate sm:max-w-[60%] md:max-w-[50%]" href="{{ route('announcements.detail', ['id' => $announcement->id]) }}">{{ $announcement->title }}</a>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-300">There are no announcements at this time.</p>
        @endforelse
    </div>

    @if ($announcements->isNotEmpty())
        <p class="text-center lg:text-right"><a wire:navigate href="{{ route('announcements.index') }}" class="text-orange-800 dark:text-orange-200 hover:underline">View all announcements...</a></p>
    @endif
</div>