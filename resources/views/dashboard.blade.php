<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ __('My Dashboard') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-2 mx-auto space-x-2 max-w-7xl sm:px-6 lg:px-8">
            <div class="col-span-2">
                <livewire:LatestAnnouncement />
            </div>

            {{-- TODO: ADD COMPONENT FOR THESE --}}
            <div class="p-4 text-gray-600 bg-gray-300 dark:bg-gray-800 rounded-xl dark:text-gray-300">Time-in / Time-out component here</div>
            <div class="p-4 text-gray-600 bg-gray-300 dark:bg-gray-800 rounded-xl dark:text-gray-300">Schedule of Employee component here</div>

            {{-- TODO: WILL BE COMMENTED OUT FOR REFERENCE ONLY --}}
            {{--
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <x-welcome />
            </div>
            --}}
        </div>
    </div>
</x-app-layout>
