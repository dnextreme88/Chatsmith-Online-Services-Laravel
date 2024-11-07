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

        <!-- Styles -->
        @filamentStyles
        @livewireStyles
        @vite('resources/css/app.css')
    </head>

    <body x-data="window.darkModeSwitcher()" x-init="init" x-bind:class="{ 'dark': switchOn }" class="antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            {{-- Navigation menu --}}
            <header x-data="{ onTopOfPage: true, scrollYPosition: 0, open: false }" class="bg-gray-200 dark:bg-gray-800">
                <nav x-on:scroll.window="scrollYPosition = window.pageYOffset; onTopOfPage = scrollYPosition < 60 ? true : false;"
                    x-bind:class="{'relative': onTopOfPage, 'fixed scale-105 w-full': !onTopOfPage}"
                    class="transition-transform bg-gray-200 border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700 duration-[450ms] z-[1]"
                >
                    {{-- View for desktop screens --}}
                    <div x-bind:class="{'px-4 py-6 sm:px-6 lg:px-8': onTopOfPage, 'px-16 py-8': !onTopOfPage}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center shrink-0">
                                <x-application-mark link="{{ route('home') }}" class="h-18" />
                            </div>
    
                            <div class="hidden sm:flex sm:items-center sm:gap-2 lg:gap-4">
                                <x-custom.dark-mode-toggle>
                                    <x-slot name="left_side">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 fill-yellow-300 dark:fill-transparent dark:text-yellow-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                                            <title>Toggle light mode</title>
                                        </svg>
                                    </x-slot>
    
                                    <x-slot name="right_side">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 fill-white">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                            <title>Toggle dark mode</title>
                                        </svg>
                                    </x-slot>
                                </x-custom.dark-mode-toggle>
    
                                <a class="text-gray-900 transition duration-150 dark:text-gray-100 hover:text-orange-800 dark:hover:text-orange-200 hover:scale-105" href="{{ route('login') }}">Employee Login</a>
    
                                <x-custom.button-contact-us />
                            </div>
    
                            <!-- Hamburger to open Responsive Navigation Menu -->
                            <div class="flex items-center me-2 sm:hidden">
                                <button x-on:click="open = !open" x-bind:class="{'focus:rotate-90': open}" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path x-bind:class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        <path x-bind:class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
    
                    {{-- Responsive Navigation Menu --}}
                    <div x-bind:class="{'flex flex-col space-y-2 space-x-1 mb-5': open, 'hidden sm:hidden': !open, 'pl-10': scrollYPosition > 60}" class="hidden sm:hidden">
                        <x-custom.dark-mode-toggle class="sm:hidden">
                            <x-slot name="left_side">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 fill-yellow-300 dark:fill-transparent dark:text-yellow-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                                    <title>Toggle light mode</title>
                                </svg>
                            </x-slot>
    
                            <x-slot name="right_side">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 fill-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                    <title>Toggle dark mode</title>
                                </svg>
                            </x-slot>
                        </x-custom.dark-mode-toggle>
    
                        <div class="pt-2 pb-3 sm:hidden">
                            <x-responsive-nav-link wire:navigate href="{{ route('login') }}">Employee Login</x-responsive-nav-link>
                        </div>
    
                        <div class="pt-2 pb-3 ps-3 pe-4 sm:hidden">
                            <x-custom.button-contact-us />
                        </div>
                    </div>
                </nav>
            </header>
    
            {{-- Page Content --}}
            <main>
                <div>{{ $slot }}</div>
            </main>
        </div>

        <!-- Scripts -->
        @filamentScripts
        @livewireScripts
        @vite('resources/js/app.js')
    </body>
</html>
