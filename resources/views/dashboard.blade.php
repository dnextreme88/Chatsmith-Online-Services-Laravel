<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">{{ __('My Dashboard') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="grid grid-cols-1 mx-auto space-y-4 max-w-7xl sm:px-6 lg:px-8 md:grid-cols-4">
            <div class="col-span-4">
                <livewire:LatestAnnouncement />
            </div>

            <div class="col-span-4 p-4 bg-gray-300 lg:col-span-3 dark:bg-gray-800 rounded-xl">
                <livewire:ListTimeRecords />
            </div>

            {{-- TODO: ADD COMPONENT FOR THESE --}}
            <div class="col-span-4 p-4 text-gray-600 bg-gray-300 lg:col-span-1 dark:bg-gray-800 rounded-xl dark:text-gray-300 lg:ml-4">Schedule of Employee component here</div>
            <div class="col-span-4 p-4 text-gray-600 bg-gray-300 lg:col-span-2 dark:bg-gray-800 rounded-xl dark:text-gray-300">My Daily Productions component here</div>
            <div class="col-span-4 p-4 text-gray-600 bg-gray-300 lg:col-span-2 dark:bg-gray-800 rounded-xl dark:text-gray-300 lg:ml-4">My Tasks component here</div>

            {{-- TODO: WILL BE COMMENTED OUT FOR REFERENCE ONLY --}}
            {{--
            <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
                <x-welcome />
            </div>
            --}}
        </div>
    </div>
</x-app-layout>
