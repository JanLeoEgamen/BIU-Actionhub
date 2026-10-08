@php
// Port of mockup/src/components/ui/select.tsx — SelectGroup.
$classes = 'overflow-hidden p-1';
@endphp

<div role="group" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</div>
