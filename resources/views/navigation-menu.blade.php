<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <x-application-mark link="{{ route('home') }}" class="h-10" />
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

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center px-1 pt-1 text-sm font-medium leading-5 border-b-2 border-transparent transition duration-150 ease-in-out focus:border-b-2 focus:outline-none focus:border-indigo-700 hover:cursor-pointer {{ request()->routeIs('forms.create') || request()->routeIs('forms.list') ? 'text-gray-900 dark:text-gray-100 border-indigo-400 dark:border-indigo-600' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700' }}">
                    <x-dropdown :align="'top'" :width="48" :toggle_dropdown_when_clicking_inside="false">
                        <x-slot name="trigger">Forms</x-slot>

                        <x-slot name="content">
                            <x-dropdown-link wire:navigate href="{{ route('forms.create') }}">Create Request</x-dropdown-link>
                            <x-dropdown-link wire:navigate href="{{ route('forms.list') }}">View Requests</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
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
                            <x-custom.dark-mode-toggle>
                                <x-slot name="title">
                                    <div class="block px-4 pt-2 text-xs text-gray-400">Dark Mode</div>
                                </x-slot>

                                <x-slot name="right_side">On</x-slot>
                            </x-custom.dark-mode-toggle>

                            <div class="border-t border-slate-200 dark:border-slate-600"></div>

                            @if (auth()->user()->is_staff)
                                <x-dropdown-link href="{{ route('filament.admin.pages.dashboard') }}">
                                    {{ __('Admin Panel') }}
                                </x-dropdown-link>
                            @endif

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

                                <x-dropdown-link x-on:click.prevent="$root.submit();" href="{{ route('logout') }}">
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

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link wire:navigate href="{{ route('forms.create') }}" :active="request()->routeIs('forms.create')">
                {{ __('Create Request') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link wire:navigate href="{{ route('forms.list') }}" :active="request()->routeIs('forms.list')">
                {{ __('View Requests') }}
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
                    <x-custom.dark-mode-toggle>
                        <x-slot name="title">
                            <div class="space-y-1 text-sm ps-4 text-slate-400">Dark Mode</div>
                        </x-slot>

                        <x-slot name="right_side">On</x-slot>
                    </x-custom.dark-mode-toggle>
                </div>

                @if (auth()->user()->is_staff)
                    <x-responsive-nav-link wire:navigate href="{{ route('filament.admin.pages.dashboard') }}" :active="request()->routeIs('filament.admin.pages.dashboard')">
                        {{ __('Admin Panel') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Account Management -->
                <div class="block px-4 pt-2 text-xs text-gray-400">
                    {{ __('Manage Account') }}
                </div>

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

                    <x-responsive-nav-link x-on:click.prevent="$root.submit();" href="{{ route('logout') }}">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
