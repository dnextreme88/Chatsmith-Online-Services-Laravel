<div>
    <x-slot name="header">
        <h2 class="space-x-1 text-xl font-semibold leading-tight">
            <a wire:navigate class="text-orange-800 transition duration-150 hover:text-orange-400 dark:hover:text-orange-600 dark:text-orange-200" href="{{ route('announcements.index') }}">Announcements</a>
            <span class="text-gray-600 dark:text-gray-300">&raquo;</span>
            <span class="text-gray-800 dark:text-gray-200">{{ $announcement->title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="px-6 py-8 bg-gray-300 rounded-lg dark:bg-gray-800">
            <h3 class="text-xl font-bold text-black dark:text-white">{{ $announcement->title }}</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300">By {{ $announcement->user->username }} on {{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y g:i:s A') }}</p>

            <div class="mt-6 text-justify text-gray-600 dark:text-gray-300 indent-4">{{ Markdown::parse($announcement->description) }}</div>
        </div>
    </div>
</div>
