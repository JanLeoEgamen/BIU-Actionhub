@props(['value'])

@php
// Port of mockup/src/components/ui/tabs.tsx — TabsContent.
$classes = 'mt-2 ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2';
@endphp

<div
    role="tabpanel"
    x-show="active === @js($value)"
    x-cloak
    {{ $attributes->merge(['class' => $classes]) }}
>{{ $slot }}</div>
