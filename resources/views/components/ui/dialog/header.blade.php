@php
// Port of mockup/src/components/ui/dialog.tsx — DialogHeader.
$classes = 'flex flex-col space-y-1.5 text-center sm:text-left';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</div>
