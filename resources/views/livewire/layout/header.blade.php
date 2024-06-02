<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    #[On('image-updated')]
    public function updateProfileImage($image = null) {
        //
    }
}
?>

<header>
    <nav class="flex justify-between h-20 w-full z-10 sm:fixed sm:top-0 sm:right-0 p-2 text-end bg-slate-100 top-nav">
        <div class="flex items-center float-start">
            <h5 class="m-0"><a class="navbar-brand homepage-url" href="{{ url('/') }}" wire:navigate>Chatsmith Online Services</a></h5>

            <!-- Left Side of Navbar -->
            <ul class="m-0 flex header-links">
                <li class="mr-2 dropdown navbar-dropdown-main">
                    <a id="leadforms-links-dropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Leadforms</a>

                    <div class="dropdown-menu navbar-dropdown-main-links" aria-labelledby="leadforms-links-dropdown">
                        <a class="dropdown-item" href="{{ route('focal_leadform') }}" wire:navigate>Focal Leadform</a>
                        <a class="dropdown-item" href="{{ route('chat_account_leadform') }}" wire:navigate>Live Chat / Smart Alto / PersistIQ Leadform</a>
                        <a class="dropdown-item" href="{{ route('plate_leadform') }}" wire:navigate>Plate IQ Leadform</a>
                    </div>
                </li>
                <li class="mr-2 nav-item"><a class="nav-link" href="{{ route('schedules.index') }}" wire:navigate>COS Schedule</a></li>
                <li class="mr-2 nav-item"><a class="nav-link" href="{{ route('daily_productions') }}" wire:navigate>Daily Productions</a></li>
                <li class="mr-2 nav-item"><a class="nav-link" href="{{ route('tasks.index') }}" wire:navigate>Daily Tasks</a></li>
            </ul>
        </div>

        <div class="flex items-center float-end header-links">
            @auth
                <div class="dropdown navbar-dropdown-user">
                    <span id="user-links-dropdown" class="flex items-center no-underline dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (auth()->user()->image)
                            <img src="{{ asset(auth()->user()->image) }}" class="img-thumbnail rounded-circle avatar-thumbnail-extrasmall">
                        @endif

                        <span>{{ Auth::user()->first_name }} <span class="caret"></span></span>
                    </span>

                    <div class="w-full float-end dropdown-menu navbar-dropdown-user-links" aria-labelledby="user-links-dropdown">
                        <a class="dropdown-item" href="{{ route('announcements.index') }}" wire:navigate>Announcements</a>
                        <a class="dropdown-item" href="{{ route('dashboard.index') }}" wire:navigate>Dashboard</a>
                        <a class="dropdown-item" href="{{ route('dashboard.profile') }}" wire:navigate>Profile</a>
                        <a class="dropdown-item" href="#" wire:click="logout">Logout</a>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 no-underline" wire:navigate>Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 no-underline" wire:navigate>Register</a>
                @endif
            @endauth
        </div>
    </nav>
</header>
