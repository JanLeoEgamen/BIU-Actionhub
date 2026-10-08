@props([
    'type' => 'submit',
    'size' => 'default',
    'disabled' => false,
])

@php
$sizeClasses = [
    'sm' => 'px-3 py-1.5 text-xs',
    'default' => 'px-4 py-2 text-sm',
    'lg' => 'px-5 py-2.5 text-base',
];

$pseudoClasses = $disabled
    ? 'opacity-60 cursor-not-allowed'
    : 'hover:bg-red-500 active:bg-red-700';

$baseClasses = 'inline-flex items-center justify-center rounded-md font-semibold uppercase tracking-widest transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-25';
$classes = $baseClasses . ' ' . $sizeClasses[$size] . ' ' . $pseudoClasses;
@endphp

<button
    type="{{ $type }}"
    @disabled($disabled)
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</button>
