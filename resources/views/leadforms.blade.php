<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">Leadforms</h2>
    </x-slot>

    <div
        x-data="{
            selectedLeadform: null,
            showLeadformChoices: true,
            showLeadform(leadform = null) {
                if (leadform != null) {
                    this.showLeadformChoices = false;
                    this.selectedLeadform = leadform;
                } else {
                    this.showLeadformChoices = true;
                    this.selectedLeadform = null;
                }
            }
        }"
        class="px-4 py-12"
    >
        <div
            x-show="showLeadformChoices"
            x-transition:enter.duration.500ms
            class="grid grid-cols-1 space-y-6 max-w-7xl lg:space-y-0 lg:grid-cols-3 lg:place-items-center lg:h-75-vh"
        >
            <div class="grid gap-3 p-3 transition-all duration-300 bg-gray-300 border-gray-300 place-items-center rounded-xl dark:border-gray-700 dark:bg-gray-800 hover:bg-gray-400 dark:hover:bg-gray-700">
                <img src="{{ asset('images/leadform_smart_alto_logo.webp') }}" class="h-52 w-52" alt="Smart Alto logo" title="Smart Alto logo" />
                <p x-on:click="showLeadform('chat')" class="text-orange-800 dark:text-orange-200 hover:underline hover:cursor-pointer">Proceed to Chat Account Leadform</p>
            </div>

            <div class="grid gap-3 p-3 transition-all duration-300 bg-gray-300 border-gray-300 place-items-center rounded-xl dark:border-gray-700 dark:bg-gray-800 hover:bg-gray-400 dark:hover:bg-gray-700">
                <img src="{{ asset('images/leadform_focal_systems_logo.webp') }}" class="h-52 w-52" alt="Focal Systems logo" title="Focal Systems logo" />
                <p x-on:click="showLeadform('focal')" class="text-orange-800 dark:text-orange-200 hover:underline hover:cursor-pointer">Proceed to Focal Leadform</p>
            </div>

            <div class="grid gap-3 p-3 transition-all duration-300 bg-gray-300 border-gray-300 place-items-center rounded-xl dark:border-gray-700 dark:bg-gray-800 hover:bg-gray-400 dark:hover:bg-gray-700">
                <img src="{{ asset('images/leadform_plate_iq_logo.webp') }}" class="h-52 w-52" alt="Plate IQ logo" title="Plate IQ logo" />
                <p x-on:click="showLeadform('plate')" class="text-orange-800 dark:text-orange-200 hover:underline hover:cursor-pointer">Proceed to Plate Leadform</p>
            </div>
        </div>

        <div
            x-show="!showLeadformChoices"
            x-bind:class="{ 'grid grid-cols-1': !showLeadformChoices, 'hidden': showLeadformChoices }"
            x-transition:enter.duration.500ms
            x-transition:leave.duration.250ms
            class="hidden space-y-4 max-w-7xl sm:px-6 lg:px-8"
        >
            <p x-on:click="showLeadform(null)" class="text-orange-800 dark:text-orange-200 hover:underline hover:cursor-pointer">Back to Leadform Choices</p>

            <div x-show="selectedLeadform == 'chat'">
                <livewire:CreateProductionChat />
            </div>

            <div x-show="selectedLeadform == 'focal'">
                <livewire:CreateProductionFocal />
            </div>

            <div x-show="selectedLeadform == 'plate'">
                <livewire:CreateProductionPlate />
            </div>
        </div>
    </div>
</x-app-layout>