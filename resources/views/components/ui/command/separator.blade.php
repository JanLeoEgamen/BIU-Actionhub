@php
// Port of mockup/src/components/ui/command.tsx — CommandSeparator.
$classes = '-mx-1 h-px bg-border';
@endphp

<div role="separator" {{ $attributes->merge(['class' => $classes]) }}></div>
