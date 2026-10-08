@props(['value', 'required' => false])

<label
    {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 tracking-tight']) }}
    <?php if (isset($required) && $required): ?>
        aria-required="true"
    <?php endif; ?>
>
    {{ $value ?? $slot }}
    @if (isset($required) && $required)
        <span class="text-red-500 ml-1">*</span>
    @endif
</label>
