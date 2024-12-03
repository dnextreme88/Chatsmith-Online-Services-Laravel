<div class="relative p-8 bg-gray-200 rounded-2xl dark:bg-gray-800 backdrop-blur before:absolute before:inset-px before:-z-10 before:shadow-xl before:shadow-black/5 sm:p-10">
    <header class="flex items-center gap-x-3">
        @if (isset($card_icon))
            <div class="p-2 rounded-full bg-gradient-to-br from-orange-200 to-orange-500">{{ $card_icon }}</div>
        @endif

        @if (isset($card_title))
            <h3 class="text-lg font-semibold tracking-tight text-gray-800 dark:text-gray-200 md:min-w-16">{{ $card_title }}</h3>
        @endif

        @if (isset($card_inline_title))
            {{ $card_inline_title }}
        @endif
    </header>

    @if (isset($card_description))
        <p class="mt-5 text-justify text-gray-600 dark:text-gray-400 md:text-left">{{ $card_description }}</p>
    @endif
</div>
