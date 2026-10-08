@php
// Port of mockup/src/components/ui/select.tsx — SelectSeparator.
$classes = '-mx-1 my-1 h-px bg-muted';
@endphp

<div role="separator" {{ $attributes->merge(['class' => $classes]) }}></div>
