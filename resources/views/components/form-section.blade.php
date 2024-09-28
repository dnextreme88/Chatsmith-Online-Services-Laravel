@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    @if (isset($title) || isset($description))
        <x-section-title>
            @if (isset($title))
                <x-slot name="title">{{ $title }}</x-slot>
            @endif

            @if (isset($description))
                <x-slot name="description">{{ $description }}</x-slot>   
            @endif
        </x-section-title>
    @endif

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div class="dark:bg-gray-800 md:px-4 md:py-6 {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end p-4 shadow bg-gray-50 dark:bg-gray-800 text-end sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
