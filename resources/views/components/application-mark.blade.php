@props(['link' => null])

@if (isset($link))
    <a wire:navigate href="{{ $link }}">
        <img src="{{ asset('images/cos-banner.webp') }}" alt="Website logo" title="Website logo" {{ $attributes->merge(['class' => 'block w-auto']) }} />
    </a>
@else
    <img src="{{ asset('images/cos-banner.webp') }}" alt="Website logo" title="Website logo" {{ $attributes->merge(['class' => 'block w-auto']) }} />
@endif
