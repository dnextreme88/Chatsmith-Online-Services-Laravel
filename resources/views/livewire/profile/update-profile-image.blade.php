<div class="w-75 mx-auto py-4 px-2">
    <div class="w-full">
        <ol class="breadcrumb w-full ps-2 py-1 inline-flex items-start gap-2">
            <li class="breadcrumb-item"><i class="fa fa-home"></i> <a class="no-underline text-orange-100" href="{{ route('dashboard.index') }}" wire:navigate>Dashboard</a></li>
            <li class="ps-0 breadcrumb-item"><a class="no-underline text-orange-100" href="{{ route('dashboard.profile') }}" wire:navigate>Settings</a></li>
            <li class="ps-0 breadcrumb-item">Update Profile Image</li>
        </ol>
    </div>

    <form wire:submit.prevent="save" class="w-full text-center">
        <div class="w-full">
            <div class="mb-4 mx-auto">
                @if ($photo)
                    <span>Photo Preview:</span>
                    <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail img-responsive mx-auto d-block avatar-thumbnail-small" alt="User profile image" title="User profile image" />
                @else
                    <img src="{{ asset(auth()->user()->image) }}" class="img-thumbnail img-responsive mx-auto d-block avatar-thumbnail-small" alt="User old profile image" title="User old profile image" />
                @endif
            </div>

            <div
                class="mb-4 w-100"
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <!-- Progress Bar -->
                <div x-show="isUploading">
                    <progress max="100" x-bind:value="progress"></progress>
                </div>

                <div class="flex items-center flex-col w-100 mb-4">
                    <div class="flex flex-row gap-8 items-center justify-between mb-4">
                        <label for="user_id">User ID</label>

                        <input class="bg-gray-300" id="user_id" type="text" placeholder="{{ $user->id }}" readonly />
                    </div>

                    <div>
                        <input type="file" wire:model="photo" />

                        @error ('photo')
                            <div class="mt-4 text-red-500 error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                @if (!$is_using_default_image)
                    <x-danger-button wire:click="reset_image">{{ __('Remove Profile Image') }}</x-danger-button>
                @endif

                @if ($photo)
                    <x-primary-button class="bg-green-600 hover:bg-green-400">{{ __('Upload Profile Image') }}</x-primary-button>
                @endif

                <x-action-message class="text-green-500 me-3" on="image-updated">{{ __('Image uploaded successfully.') }}</x-action-message>
                <x-action-message class="text-red-500 me-3" on="image-removed">{{ __('Image removed successfully! Your profile image is now set to default.') }}</x-action-message>
            </div>
        </div>
    </form>
</div>
