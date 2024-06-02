@props(['nav_links'])

<div class="w-full">
    <ol {{ $attributes->merge(['class' => 'breadcrumb w-full ps-2 py-1 inline-flex items-start gap-2']) }}>
        <li class="ps-0 breadcrumb-item"><i class="fa fa-home"></i> <a class="no-underline text-orange-100" href="{{ route('home') }}" wire:navigate>Home</a></li>

        @if ($nav_links)
            @foreach ((array) $nav_links as $nav_link => $url)
                <li class="ps-0 breadcrumb-item"><a class="no-underline text-orange-100" href="{{ $url }}" wire:navigate>{{ $nav_link }}</a></li>

                @if ($loop->last)
                    <li class="ps-0 breadcrumb-item">{{ $slot }}</li>
                @endif
            @endforeach
        @else
            <li class="ps-0 breadcrumb-item">{{ $slot }}</li>
        @endif
    </ol>
</div>
