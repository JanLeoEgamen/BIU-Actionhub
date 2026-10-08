@php
// Port of mockup/src/components/ui/skeleton.tsx.
$classes = 'animate-pulse rounded-md bg-primary/10';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}></div>
