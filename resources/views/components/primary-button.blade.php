@props([
    'type' => 'submit',
    'variant' => 'primary',
    'size' => 'default',
    'disabled' => false,
    'tag' => 'button',
    'href' => '#',
])

@php
$sizeClasses = [
    'sm' => 'px-3 py-1.5 text-xs',
    'default' => 'px-4 py-2 text-sm',
    'lg' => 'px-5 py-2.5 text-base',
];

$pseudoClasses = $disabled
    ? 'opacity-60 cursor-not-allowed'
    : 'hover:opacity-90 active:opacity-100';

$baseClasses = 'inline-flex items-center justify-center rounded-md font-semibold uppercase tracking-widest transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2';
$primary = 'bg-gray-800 text-white border-transparent focus:ring-gray-700';
$secondary = 'bg-white border border-gray-300 text-gray-700 focus:ring-indigo-500 hover:bg-gray-50';
$danger = 'bg-red-600 text-white border-transparent focus:ring-red-500';

$classes = $baseClasses . ' ' . $sizeClasses[$size] . ' ' . ($variant === 'danger' ? $danger : ($variant === 'secondary' ? $secondary : $primary)) . ' ' . $pseudoClasses;
@endphp

@if ($tag === 'a')
    <a
        href="{{ $href }}"
        @disabled($disabled)
        {{ $attributes->merge(['class' => $classes]) }}
    >
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        @disabled($disabled)
        {{ $attributes->merge(['class' => $classes]) }}
    >
        {{ $slot }}
    </button>
@endif
