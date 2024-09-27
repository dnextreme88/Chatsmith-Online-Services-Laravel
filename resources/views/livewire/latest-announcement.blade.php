<div class="flex flex-col items-center gap-2 mb-4 md:flex-row">
    <div class="w-1/4 px-2 m-auto">
        <img class="h-20 w-20 mx-auto" src="{{ $latest_announcement->user->image }}" alt="Author image" title="Author image" />
    </div>

    <div class="w-full px-6 py-3 bg-gray-300 dark:bg-gray-800 dark:after:border-r-gray-800 md:speech-bubble">
        <h2 class="mb-2 text-3xl tracking-wide text-black dark:text-white md:w-3/4">Latest Announcement</h2>
        <h3 class="mt-6 text-xl font-bold text-black dark:text-white md:w-3/4">{{ $latest_announcement->title }}</h3>

        <p class="mb-6 text-left text-gray-600 dark:text-gray-300">By {{ $latest_announcement->user->username }} on {{ \Carbon\Carbon::parse($latest_announcement->created_at)->format('F j, Y g:i:s A') }}</p>

        @if (str_word_count($latest_announcement->description) > 200)
            <div class="text-justify text-gray-600 dark:text-gray-300 indent-4 truncate-text-with-dots">{!! Markdown::parse($latest_announcement->description) !!}</div>
            <a href="#" class="inline-block mt-2 mb-4 text-orange-800 dark:text-orange-200 hover:underline read-more-text" title="Click to expand announcement text">Read more</a>
        @else
            <div class="text-justify text-gray-600 dark:text-gray-300 indent-4">{{ Markdown::parse($latest_announcement->description) }}</div>
        @endif

        <p class="text-right"><a wire:navigate href="{{ route('announcements.index') }}" class="text-orange-800 dark:text-orange-200 hover:underline">View all announcements...</a></p>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/announcements/index.js') }}"></script>
@endpush
