<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ __('Announcements') }}</h2>
    </x-slot>

    <div class="py-12">
        @forelse ($announcements as $announcement)
            <div class="mb-4 border border-gray-300 rounded dark:border-gray-600">
                <div class="p-2 bg-gray-300 border-b border-gray-300 dark:bg-gray-800 dark:border-gray-600 sm:p-4">
                    <h3 class="text-xl font-bold text-orange-800 hover:underline dark:text-orange-200 md:w-3/4">
                        <a wire:navigate href="{{ route('announcements.detail', ['id' => $announcement->id]) }}">{{ $announcement->title }}</a>
                    </h3>

                    <p class="text-sm text-gray-600 dark:text-gray-300">By {{ $announcement->user->username }} on {{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y g:i:s A') }}</p>
                </div>

                <div class="p-2 sm:p-4">
                    @if (str_word_count($announcement->description) > 200)
                        <div class="mt-2 text-justify text-gray-600 dark:text-gray-300 indent-4 truncate-text-with-dots">{!! Markdown::parse($announcement->description) !!}</div>
                        <a href="#" class="inline-block mt-2 mb-4 text-orange-800 dark:text-orange-200 hover:underline read-more-text" title="Click to expand announcement text">Read more</a>
                    @else
                        <div class="mt-2 text-justify text-gray-600 dark:text-gray-300 indent-4">{{ Markdown::parse($announcement->description) }}</div>
                    @endif
                </div>
            </div>

            {{ $announcements->withQueryString()->links() }}
        @empty
            <p class="dark:text-white">No announcements found.</p>
        @endforelse
    </div>
</div>


@push('scripts')
    <script src="{{ asset('js/announcements/index.js') }}"></script>
@endpush
