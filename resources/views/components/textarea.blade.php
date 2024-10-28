@props([
    'placeholder_message' => 'Message',
    'include_chars_left' => false,
    'livewire_event_to_listen' => null
])

<div
    x-data="{
        characterCount: 0,
        textareaMaxLength: {{ isset($attributes['maxlength']) ? $attributes['maxlength'] : 0 }},
        changeCharacterCount() {
            this.characterCount = $refs.textareaElement.value.length;
        },
    }"
    x-init="
        console.log('maxlength')
        $watch('characterCount', (value) => {
            console.log(value);
        });

        {{-- $wire.on('{{ $livewire_event_to_listen }}', function() { --}}
        $wire.on('contact-us-created', function() {
            characterCount = 0;
        });
    "
>
    <textarea x-ref="textareaElement" x-on:keyup="changeCharacterCount" {!! $attributes->merge(['class' => 'block w-full rounded-md shadow-sm min-h-[100px] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 read-only:bg-gray-200 dark:read-only:bg-gray-600 read-only:text-gray-400 dark:read-only:text-gray-500 placeholder:italic']) !!} placeholder="{{ $placeholder_message }}">
        {{ $slot }}
    </textarea>

    <small class="text-xs text-slate-700 dark:text-slate-300"><span x-text="characterCount"></span> / <span x-text="textareaMaxLength"></span> characters</small>
</div>