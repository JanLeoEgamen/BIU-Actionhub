@props(['variant' => 'default'])

@php
// Port of mockup/src/components/ui/alert.tsx (alertVariants via cva).
$variantClasses = [
    'default' => 'bg-background text-foreground',
    'destructive' => 'border-destructive/50 text-destructive dark:border-destructive [&>svg]:text-destructive',
];

$baseClasses = 'relative w-full rounded-lg border px-4 py-3 text-sm [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground [&>svg~*]:pl-7';

$classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['default']);
@endphp

<div role="alert" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</div>
