<div>
    <h3 class="text-3xl font-bold text-gray-600 dark:text-gray-300">Latest Clock-Ins</h3>

    <div class="mx-3 my-6">
        @forelse ($time_records as $time_record)
            <div class="flex flex-col items-start justify-between w-full gap-0 mb-6 sm:items-center sm:mb-2 sm:gap-y-4 sm:flex-row">
                <span class="font-bold text-gray-600 dark:text-gray-300">{{ \Carbon\Carbon::parse($time_record->timestamp_in)->format('M d, Y h:i:s A') }}</span>
                <span class="sm:max-w-[60%] text-gray-600 sm:truncate dark:text-gray-300 min-w-16">{{ $time_record->user->last_name }}, {{ $time_record->user->first_name }} {{ $time_record->user->maiden_name }}</span>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-300">There are no clock-ins at this time.</p>
        @endforelse
    </div>
</div>
