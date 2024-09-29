@props([
    'align' => 'right',
    'width' => '48',
    'content_classes' => 'py-1 bg-white dark:bg-gray-700',
    'dropdown_classes' => '',
    'toggle_dropdown_when_clicking_inside' => true
])

@php
    $alignment_classes = match($align) {
        'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
        'top' => 'origin-top',
        'none', 'false' => '',
        default => 'ltr:origin-top-right rtl:origin-top-left end-0',
    };

    $width = match($width) {
        '48' => 'w-48',
        '60' => 'w-60',
        default => 'w-48',
    };
@endphp

<div class="relative" x-data="{ open: false }" x-on:click.away="open = false" x-on:close.stop="open = false">
    <div x-on:click="open = !open">
        {{ $trigger }}
    </div>

    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-50 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignment_classes }} {{ $dropdown_classes }}"
        style="display: none;"
        {!! $toggle_dropdown_when_clicking_inside ? 'x-on:click="open = false"' : '' !!}
    >
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $content_classes }}">{{ $content }}</div>
    </div>
</div>
