@props(['benefits' => []])

<div {{ $attributes->merge(['class' => 'grid justify-center grid-cols-1']) }}>
    @if (isset($card_title))
        <h4 class="py-2 text-xl text-center text-gray-900 bg-gray-100 rounded-t-2xl dark:bg-gray-600 dark:text-gray-200 font-poppins">{{ $card_title }}</h4>
    @endif

    @if (isset($card_pricing))
        <div class="p-4 bg-gray-300 dark:bg-gray-500">
            <div class="p-5 mx-auto text-center w-fit">
                <span class="text-4xl font-bold text-green-800 dark:text-green-300">{{ $card_pricing }}</span> <span class="text-xl md:inline-block md:text-gray-900 md:dark:text-gray-200">/ month</span>
            </div>
        </div>
    @endif

    @if (count($benefits) > 0)
        @foreach ($benefits as $key => $value)
            <div class="flex items-center gap-2 px-2 py-4 bg-gray-100 dark:bg-gray-600 last:rounded-b-2xl">
                <span class="self-start px-3 py-1 text-gray-100 bg-green-700 rounded-lg">{{ $value }}</span>
                <span class="text-gray-900 break-all dark:text-gray-200">{{ $key }}</span>
            </div>
        @endforeach
    @endif
</div>
