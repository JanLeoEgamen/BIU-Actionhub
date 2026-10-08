@props([
    'type' => 'button',
    'variant' => 'default',
    'size' => 'default',
    'disabled' => false,
    'tag' => 'button',
    'href' => '#',
])

@php
// Port of mockup/src/components/ui/button.tsx (buttonVariants via cva).
// Bare `disabled` attribute arrives as "" and should count as true.
$disabled = is_string($disabled) ? $disabled !== 'false' : $disabled;

$sizeClasses = [
    'default' => 'h-9 px-4 py-2',
    'sm' => 'h-8 rounded-md px-3 text-xs',
    'lg' => 'h-10 rounded-md px-8',
    'icon' => 'h-9 w-9',
];

$variantClasses = [
    'default' => 'bg-primary text-primary-foreground shadow hover:bg-primary/90',
    'destructive' => 'bg-destructive text-destructive-foreground shadow-sm hover:bg-destructive/90',
    'outline' => 'border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground',
    'secondary' => 'bg-secondary text-secondary-foreground shadow-sm hover:bg-secondary/80',
    'ghost' => 'hover:bg-accent hover:text-accent-foreground',
    'link' => 'text-primary underline-offset-4 hover:underline',
];

$baseClasses = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium cursor-pointer transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0';

$classes = $baseClasses
    . ' ' . ($variantClasses[$variant] ?? $variantClasses['default'])
    . ' ' . ($sizeClasses[$size] ?? $sizeClasses['default']);
@endphp

@if ($tag === 'a')
    <a
        href="{{ $href }}"
        @disabled($disabled)
        {{ $attributes->merge(['class' => $classes]) }}
    >{{ $slot }}</a>
@else
    <button
        type="{{ $type }}"
        @disabled($disabled)
        {{ $attributes->merge(['class' => $classes]) }}
    >{{ $slot }}</button>
@endif
