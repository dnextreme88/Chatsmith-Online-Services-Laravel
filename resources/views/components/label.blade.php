@props(['value', 'is_required' => false])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}

    @if ($is_required)
        <span class="text-red-500 dark:text-red-300">*</span>
    @endif
</label>
