@props([
    'type' => 'button',
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
    : 'hover:bg-gray-50 active:bg-gray-100';

$baseClasses = 'inline-flex items-center justify-center rounded-md font-semibold uppercase tracking-widest transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25';
$classes = $baseClasses . ' ' . $sizeClasses[$size] . ' ' . $pseudoClasses;
@endphp

@if ($tag === 'a')
    <a
        href="{{ $href ?? '#' }}"
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
