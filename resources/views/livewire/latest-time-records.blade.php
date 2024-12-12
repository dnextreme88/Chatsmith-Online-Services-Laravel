<div>
    <h3 class="flex items-center gap-2 text-3xl font-bold text-gray-600 dark:text-gray-300">
        <svg class="text-orange-800 dark:text-orange-200 fill-transparent size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>

        <span>Latest Clock-Ins</span>
    </h3>

    <div class="mx-3 my-6 space-y-4">
        @forelse ($time_records as $time_record)
            <div class="flex flex-col items-start justify-between w-full gap-0 sm:items-center sm:gap-y-4 sm:flex-row">
                <span class="font-bold text-gray-600 dark:text-gray-300 w-[200px]">{{ \Carbon\Carbon::parse($time_record->timestamp_in)->format('M d, Y h:i:s A') }}</span>
                <span class="min-w-16 text-gray-600 dark:text-gray-300 sm:truncate sm:max-w-[60%] md:max-w-[50%]">{{ $time_record->user->last_name }}, {{ $time_record->user->first_name }} {{ $time_record->user->maiden_name }}</span>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-300">There are no clock-ins at this time.</p>
        @endforelse
    </div>
</div>
