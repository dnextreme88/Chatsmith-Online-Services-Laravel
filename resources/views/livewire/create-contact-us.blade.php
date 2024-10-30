<div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-8 py-16">
        <img src="{{ asset('images/bg_contact_us.webp') }}" class="mx-auto" alt="Contact Us background" title="Contact Us background" />
    </div>

    <x-form-section submit="create_contact_us">
        <x-slot name="title">Reach out to us!</x-slot>

        <x-slot name="description">Send us a message using the form below. Your responses will be kept confidential. Chatsmith Online Services will reach out to you in a few days.</x-slot>

        <x-slot name="form">
            <div class="col-span-6">
                <x-label :is_required="true" :value="'Name'" />
                <x-input wire:model="name" id="name" class="block w-full mt-1 placeholder:italic" type="text" name="name" required autofocus autocomplete="name" placeholder="eg. John Doe" />
                <x-input-error for="name" class="mt-2" />
            </div>

            <div class="col-span-6 mt-4">
                <x-label :is_required="true" :value="'Email'" />
                <x-input wire:model="email" id="email" class="block w-full mt-1 placeholder:italic" type="text" name="email" required autofocus autocomplete="email" placeholder="username@domain.com" />
                <x-input-error for="email" class="mt-2" />
            </div>

            <div class="col-span-6 mt-4">
                <x-label :is_required="true" :value="'Message'" />
                <x-textarea :livewire_event_to_listen="'contact-us-created'" :placeholder_message="'Please enter your message here'" wire:model="message" class="resize-none" id="message" maxlength="255" rows="7"></x-textarea>
                <x-input-error for="message" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="text-green-700 me-3 dark:text-green-200" on="contact-us-created">Your response has been received. We will be reaching out to you in a few days.</x-action-message>

            <x-button wire:loading.attr="disabled">Submit</x-button>
        </x-slot>
    </x-form-section>
</div>
