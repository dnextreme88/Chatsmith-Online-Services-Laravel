<x-form-section submit="update_profile_info">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input
                    x-ref="profile_photo_path"
                    x-on:change="
                        photoName = $refs.profile_photo_path.files[0].name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            photoPreview = e.target.result;
                        };
                        reader.readAsDataURL($refs.profile_photo_path.files[0]);"
                    wire:model.live="uploaded_photo"
                    class="hidden"
                    type="file"
                    id="photo"
                />

                <x-label for="uploaded_photo" value="{{ __('Profile Photo') }}" />

                <!-- Current Profile Photo -->
                <div x-show="!photoPreview" class="mt-2">
                    <img class="rounded-full h-20 w-20 object-cover" src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" />
                </div>

                <!-- New Profile Photo Preview -->
                <div x-show="photoPreview" class="mt-2" style="display: none;">
                    <span x-bind:style="'background-image: url(\'' + photoPreview + '\');'" class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"></span>
                </div>

                <x-secondary-button x-on:click.prevent="$refs.profile_photo_path.click()" class="mt-2 me-2" type="button">{{ __('Select A New Photo') }}</x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button x-on:click="photoPreview = null" wire:click="delete_profile_photo" class="mt-2" type="button">{{ __('Remove Photo') }}</x-secondary-button>
                @endif

                <x-input-error for="uploaded_photo" class="mt-2" />
            </div>
        @endif

        <div class="col-span-6 mt-4">
            <x-label for="user_id" :value="__('User ID')" />
            <p class="w-full text-lg dark:text-gray-400">{{ $user_id }}</p>
        </div>

        <div class="col-span-6 mt-4">
            <x-label for="username" :value="__('Username')" />
            <p class="w-full text-lg dark:text-gray-400">{{ $username }}</p>
        </div>

        <div class="col-span-6 mt-4">
            <x-label for="first_name" :value="__('First Name')" />
            <x-input wire:model="first_name" id="first_name" class="block mt-1 w-full uppercase" type="text" name="first_name" required autofocus autocomplete="first_name" />
            <x-input-error for="first_name" class="mt-2" />
        </div>

        <div class="col-span-6 mt-4">
            <x-label for="maiden_name" :value="__('Maiden Name')" />
            <x-input wire:model="maiden_name" id="maiden_name" class="block mt-1 w-full uppercase" type="text" name="maiden_name" autofocus autocomplete="maiden_name" />
            <x-input-error for="maiden_name" class="mt-2" />
        </div>

        <div class="col-span-6 mt-4">
            <x-label for="last_name" :value="__('Last Name')" />
            <x-input wire:model="last_name" id="last_name" class="block mt-1 w-full uppercase" type="text" name="last_name" required autofocus autocomplete="last_name" />
            <x-input-error for="last_name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 mt-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input wire:model="email" id="email" class="mt-1 block w-full lowercase" type="email" required autocomplete="email" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 dark:text-white">
                    {{ __('Your email address is unverified.') }}

                    <button
                        wire:click.prevent="sendEmailVerification"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        type="button"
                    >
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3 text-green-700 dark:text-green-200" on="profile-updated">{{ __('Profile updated.') }}</x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">{{ __('Save') }}</x-button>
    </x-slot>
</x-form-section>
