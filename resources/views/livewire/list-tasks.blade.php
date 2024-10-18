<div>
    <h3 class="text-2xl font-bold text-gray-600 dark:text-gray-300">Today's Tasks ({{ $today->format('M. j, Y') }})</h3>

    <div class="my-6">
        @forelse ($tasks as $task)
            <div class="flex items-center justify-between w-full sm:w-1/2">
                <span class="font-bold text-gray-600 dark:text-gray-300">{{ $task->time_range->time_range }}</span>
                <span class="text-gray-600 dark:text-gray-300">{{ $task->task_name }}</span>
            </div>
        @empty
            <p class="text-gray-600 dark:text-gray-300">You currently don't have any assigned tasks today. If today is your shift, please contact the staff.</p>
        @endforelse
    </div>
</div>
