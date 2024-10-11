<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a wire:navigate href="{{ route('dashboard') }}">
                        <x-application-mark class="block w-auto h-9" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link wire:navigate href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link wire:navigate href="{{ route('leadforms') }}" :active="request()->routeIs('leadforms')">
                        {{ __('Leadforms') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Settings Dropdown -->
                <div class="relative ms-3">
                    <x-dropdown :align="'right'" :width="48" :toggle_dropdown_when_clicking_inside="false">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                    <img class="object-cover h-8 w-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->last_name }}" />
                                </button>
                            @else
                                <span x-bind:class="{'dark:bg-gray-700': open}" class="inline-flex items-center rounded-md">
                                    <button class="inline-flex items-center p-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700" type="button">
                                        <span class="pl-1 pr-3 dark:text-gray-400">{{ Auth::user()->last_name }}</span>

                                        <svg x-bind:class="{'rotate-180': open}" class="h-4 w-4 transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            {{-- Dark mode toggle --}}
                            <div class="block px-4 pt-2 text-xs text-gray-400">Dark Mode</div>

                            <div x-data="window.darkModeSwitcher()" x-init="init" @keydown.window.tab="switchOn = false" class="flex px-2 py-2 space-x-2 place-content-start">
                                <input x-bind:checked="switchOn" class="hidden" type="checkbox" name="switch" />

                                <button
                                    x-ref="switchButton"
                                    x-on:click="switchOn = !switchOn; switchTheme()"
                                    x-bind:class="{'bg-blue-400': switchOn, 'bg-slate-400': !switchOn}"
                                    class="relative inline-flex h-5 py-0.5 ml-2 focus:outline-none rounded-full w-9"
                                    type="button"
                                >
                                    <span x-bind:class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'" class="h-4 w-4 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
                                </button>

                                <label
                                    x-on:click="$refs.switchButton.click(); $refs.switchButton.focus()"
                                    x-bind:class="{ 'text-slate-300': switchOn, 'text-slate-700': !switchOn }"
                                    x-bind:id="$id('switch')"
                                    class="text-sm select-none"
                                >
                                    On
                                </label>
                            </div>

                            <div class="border-t border-slate-200 dark:border-slate-600"></div>

                            <!-- Account Management -->
                            <div class="block px-4 pt-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link wire:navigate href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link wire:navigate href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link x-on:click.prevent="$root.submit();" wire:navigate href="{{ route('logout') }}">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button x-on:click="open = !open" x-bind:class="{'focus:rotate-90': open}" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path x-bind:class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-bind:class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-bind:class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link wire:navigate href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link wire:navigate href="{{ route('leadforms') }}" :active="request()->routeIs('leadforms')">
                {{ __('Leadforms') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="object-cover h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->last_name }}" />
                    </div>
                @endif

                <div>
                    <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->last_name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                {{-- Dark mode toggle --}}
                <div class="pt-4 pb-1 border-t border-blue-200 dark:border-slate-600">
                    <div class="space-y-1 text-sm ps-4 text-slate-400">Dark Mode</div>

                    <div x-data="window.darkModeSwitcher()" x-init="init" x-on:keydown.window.tab="switchOn = false" class="flex px-2 py-2 space-x-2 place-content-start">
                        <input x-bind:checked="switchOn" class="hidden" type="checkbox" name="switch" />

                        <button
                            x-ref="switchButton"
                            x-on:click="switchOn = !switchOn; switchTheme()"
                            x-bind:class="{'bg-blue-400': switchOn, 'bg-slate-400': !switchOn}"
                            class="relative inline-flex h-6 py-0.5 ml-2 focus:outline-none rounded-full w-10"
                            type="button"
                        >
                            <span x-bind:class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'" class="h-5 w-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
                        </button>

                        <label
                            x-on:click="$refs.switchButton.click(); $refs.switchButton.focus()"
                            x-bind:id="$id('switch')"
                            x-bind:class="{ 'text-slate-400': switchOn, 'text-white': !switchOn }"
                            class="select-none"
                        >
                            On
                        </label>
                    </div>
                </div>

                <!-- Account Management -->
                <x-responsive-nav-link wire:navigate href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link wire:navigate href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link x-on:click.prevent="$root.submit();" wire:navigate href="{{ route('logout') }}">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
