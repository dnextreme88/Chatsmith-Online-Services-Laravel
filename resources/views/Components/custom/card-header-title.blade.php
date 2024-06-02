<div {{ $attributes->merge(['class' => 'p-2 mb-2 border-b-2 border-b-orange-500 bg-slate-200']) }}>
    <span class="text-start">{{ $slot }}</span>
</div>

{{-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> --}}
{{-- 
@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
 --}}

{{-- <div class="p-2 mb-2 border-b-2 border-b-orange-500 bg-slate-200">
    <span class="text-start">Welcome, {{ $user->first_name }}!</span>
</div> --}}

{{-- SAMPLE USAGE:
        <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>
--}}