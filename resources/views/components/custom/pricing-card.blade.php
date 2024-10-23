@props(['benefits' => []])

<div {{ $attributes->merge(['class' => 'grid justify-center grid-cols-1']) }}>
    @if (isset($card_title))
        <h4 class="py-2 text-xl text-center text-gray-900 bg-gray-100 rounded-t-2xl dark:bg-gray-600 dark:text-gray-200 font-poppins">{{ $card_title }}</h4>
    @endif

    @if (isset($card_pricing))
        <div class="p-4 bg-gray-300 dark:bg-gray-500">
            <div class="p-5 mx-auto text-center text-gray-900 bg-gray-200 rounded-full w-fit dark:bg-gray-700 dark:text-gray-200">
                <span class="text-3xl font-bold text-green-900 dark:text-green-200">{{ $card_pricing }}</span> <span class="text-xl md:block">/ month</span>
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

        {{-- TODO: TO UNCOMMENT ONCE THE PAGE FOR CONTACT US IS DONE AND THERE IS A TABLE ASSOCIATED WITH IT --}}
        {{-- 
        <div class="w-full px-2 py-6 text-center bg-gray-400 dark:bg-gray-600">
            <a
                href="#"
                class="border-none hover:shadow-button-none focus:border-white focus:shadow-button-none focus:text-white leading-none whitespace-nowrap tracking-wider rounded-full py-2 xl:py-2.5 md:text-center px-3 lg:px-4 xl:px-5 uppercase text-white border bg-[length:1000%_1000%] transition-all duration-500 active:bg-gradient-to-l active:border-transparent active:from-yellow active:to-yellow active:shadow-button-none active:text-black word-spacing-tight text-sm lg:text-base xl:text-lg bg-gradient-yellow animate-shimmering-gradient"
            >
                Contact Us
            </a>
        </div>
        --}}
    @endif
</div>
