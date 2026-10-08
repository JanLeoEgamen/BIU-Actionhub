@props([
    'disabled' => false,
    'size' => 'default',
    'help' => null,
    'showErrors' => true,
])

@php
$sizeClasses = [
    'sm' => 'h-8 px-3 text-sm',
    'default' => 'h-10 px-3 text-base',
    'lg' => 'h-12 px-4 text-base',
];

$baseClasses = 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm transition duration-150 ease-in-out';
$size = $sizeClasses[$size];
$disabledClass = $disabled ? 'opacity-60 cursor-not-allowed bg-gray-50' : 'bg-white';
$inputClasses = $size . ' ' . $disabledClass;
// Preserve any extra classes the caller passes (e.g. "mt-1", "w-full").
$fullClasses = $inputClasses . ' ' . $baseClasses . ' w-full ' . $attributes->get('class', '');
@endphp

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => $fullClasses]) }}
>

@if (($showErrors ?? true) && $help)
    <p class="mt-1 text-sm text-gray-500">{{ $help }}</p>
@endif
