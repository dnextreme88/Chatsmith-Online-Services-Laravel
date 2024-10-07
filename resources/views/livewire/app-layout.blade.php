<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />

        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('images/cos-favicon.ico') }}" />

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        {{-- Styles --}}
        @filamentStyles
        @livewireStyles
        @vite('resources/css/app.css')

        @stack('styles')
    </head>

    <body x-data="themeSwitcher()" x-bind:class="{'dark': switchOn}" class="antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            {{-- Page Heading --}}
            @if (isset($header))
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">{{ $header }}</div>
                </header>
            @endif

            {{-- Page Content --}}
            <main>
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">{{ $slot }}</div>
            </main>
        </div>

        @stack('modals')

        {{-- Scripts --}}
        @filamentScripts
        @livewireScripts
        @vite('resources/js/app.js')

        @stack('scripts')
    </body>
</html>
