@props([
    'value' => null,
    'defaultValue' => null,
])

@php
// Port of mockup/src/components/ui/tabs.tsx — Tabs root.
// Alpine keeps the active tab; triggers/content read it from this scope.
$active = $value ?? $defaultValue;
@endphp

<div
    x-data="{ active: @js($active) }"
    x-cloak
    {{ $attributes }}
>{{ $slot }}</div>
