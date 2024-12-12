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
            {{-- We need to add this to achieve a "sticky" element when scrolling down. --}}
            {{-- Unlike position: fixed, the <header> element will only stick when the user scrolls down to where the element starts --}}
            <div class="bg-gray-200 dark:bg-gray-800 h-9">&nbsp;</div>

            {{-- Navigation menu --}}
            <header x-data="{ open: false }" class="bg-gray-200 dark:bg-gray-800 top-0 sticky z-[1]">
                <nav class="bg-gray-200 dark:bg-gray-800">
                    {{-- View for desktop screens --}}
                    <div class="p-4 sm:px-6 lg:px-8">
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
                    <div x-bind:class="{'flex flex-col space-y-2 space-x-1 mb-5': open, 'hidden sm:hidden': !open}" class="hidden sm:hidden">
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

            <footer class="flex flex-col justify-between px-4 py-6 bg-gray-200 lg:flex-row dark:bg-gray-800 sm:px-6 lg:px-8">
                <div class="order-2 col-span-2 pt-8 mt-2 text-center text-gray-900 lg:order-first lg:pt-0 lg:text-left dark:text-gray-100">
                    <p>Copyright &copy; 2024 by Kevin Decena.</p>
                    <p>Per DTI-NCR Permit No. 01302020, Series of 2020.</p>
                </div>

                <div class="flex flex-col items-center order-1 space-y-6 text-gray-900 lg:items-end lg:order-last dark:text-gray-100">
                    <div class="flex flex-row items-center space-x-4">
                        <a class="text-gray-900 transition duration-150 dark:text-gray-100 hover:text-orange-800 dark:hover:text-orange-200 hover:scale-105" href="{{ route('careers') }}">Careers</a>
                        <a class="text-gray-900 transition duration-150 dark:text-gray-100 hover:text-orange-800 dark:hover:text-orange-200 hover:scale-105" href="{{ route('privacy_policy') }}">Privacy Policy</a>
                        <a class="text-gray-900 transition duration-150 dark:text-gray-100 hover:text-orange-800 dark:hover:text-orange-200 hover:scale-105" href="{{ route('terms_and_conditions') }}">Terms and Conditions</a>
                        <x-custom.button-contact-us />
                    </div>

                    <p class="hidden text-xl text-orange-600 uppercase lg:block dark:text-orange-400">Connect with us!</p>

                    <div class="flex flex-row space-x-3">
                        <a class="p-3 transition duration-200 rounded-full bg-gradient-to-br from-orange-300 to-orange-500 fill-gray-100 dark:from-orange-500 dark:to-orange-700 hover:bg-gradient-to-tr dark:bg-gradient-to-bl dark:hover:bg-gradient-to-tl hover:translate-y-1.5" href="https://www.facebook.com/Chatsmithonline" target="_blank" title="Facebook link">
                            <svg class="text-transparent dark:text-gray-200 size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.238 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647Z" />
                            </svg>
                        </a>

                        <a class="p-3 transition duration-200 rounded-full bg-gradient-to-br from-orange-300 to-orange-500 fill-gray-100 dark:from-orange-500 dark:to-orange-700 hover:bg-gradient-to-tr dark:bg-gradient-to-bl dark:hover:bg-gradient-to-tl hover:translate-y-1.5" href="https://www.linkedin.com/company/chatsmith-online/about/" target="_blank" title="LinkedIn link">
                            <svg class="text-transparent dark:text-gray-200 size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>

                        <a class="p-3 transition duration-200 rounded-full bg-gradient-to-br from-orange-300 to-orange-500 fill-gray-100 dark:from-orange-500 dark:to-orange-700 hover:bg-gradient-to-tr dark:bg-gradient-to-bl dark:hover:bg-gradient-to-tl hover:translate-y-1.5" href="https://twitter.com/chatsmithonline" target="_blank" title="Twitter link">
                            <svg class="text-transparent dark:text-gray-200 size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Scripts -->
        @filamentScripts
        @livewireScripts
        @vite('resources/js/app.js')
    </body>
</html>
