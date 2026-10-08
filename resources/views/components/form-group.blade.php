@props([
    'label' => null,
    'description' => '',
    'id' => null,
    'required' => false,
])

@php
// Fixed: the previous file contained literal "\n" sequences and referenced
// undefined $id/$required variables, which broke rendering.
$required = $required !== false && $required !== null && $required !== 'false';
@endphp

<div class="space-y-2">
    @if ($label)
        <label for="{{ $id }}" class="text-sm font-medium text-gray-700">
            {{ $label }}
            @if ($required)
                <span class="text-red-500 ml-1">*</span>
            @endif
        </label>
    @endif

    @if ($description)
        <p class="text-sm text-gray-500">{{ $description }}</p>
    @endif

    {{ $slot }}
</div>
