@props(['value' => null])

@php
// Port of mockup/src/components/ui/label.tsx.
$classes = 'text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70';
@endphp

<label {{ $attributes->merge(['class' => $classes]) }}>{{ $value ?? $slot }}</label>
