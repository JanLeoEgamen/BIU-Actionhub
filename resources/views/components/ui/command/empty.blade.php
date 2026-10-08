@php
// Port of mockup/src/components/ui/command.tsx — CommandEmpty.
$classes = 'py-6 text-center text-sm';
@endphp

<div x-show="count === 0" x-cloak {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</div>
