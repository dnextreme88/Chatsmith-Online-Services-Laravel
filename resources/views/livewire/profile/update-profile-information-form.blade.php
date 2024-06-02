<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public int $user_id = 0;
    public string $first_name = '';
    public string $maiden_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $username = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->user_id = Auth::user()->id ? Auth::user()->id : 0;
        $this->first_name = Auth::user()->first_name ? Auth::user()->first_name : '';
        $this->maiden_name = Auth::user()->maiden_name ? Auth::user()->maiden_name : '';
        $this->last_name = Auth::user()->last_name ? Auth::user()->last_name : '';
        $this->email = Auth::user()->email ? Auth::user()->email : '';
        $this->username = Auth::user()->username ? Auth::user()->username : '';
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function update_profile_info(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'maiden_name' => ['string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function send_verification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: RouteServiceProvider::HOME);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}
?>

<section class="mb-4">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="update_profile_info" class="mt-6 space-y-6">
        <div class="mt-4">
            <x-input-label for="user_id" :value="__('User ID')" />
            <x-text-input wire:model="user_id" id="user_id" class="block mt-1 w-full bg-gray-300 " type="text" name="user_id" readonly />
        </div>

        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input wire:model="username" id="username" class="block mt-1 w-full bg-gray-300 " type="text" name="username" placeholder="{{ $user_id }}" autocomplete="username" readonly />
        </div>

        <div class="mt-4">
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="maiden_name" :value="__('Maiden Name')" />
            <x-text-input wire:model="maiden_name" id="maiden_name" class="block mt-1 w-full" type="text" name="maiden_name" autofocus autocomplete="maiden_name" />
            <x-input-error :messages="$errors->get('maiden_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" required autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required placeholder="user@domain.com" autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="send_verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <a class="no-underline text-orange-500" href="{{ route('dashboard.update_profile_image') }}" wire:navigate>Click here to update profile image</a>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-green-600 hover:bg-green-400">{{ __('Save') }}</x-primary-button>

            <x-action-message class="text-green-500 me-3" on="profile-updated">{{ __('Profile updated.') }}</x-action-message>
        </div>
    </form>
</section>
