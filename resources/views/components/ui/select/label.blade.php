@php
// Port of mockup/src/components/ui/select.tsx — SelectLabel.
$classes = 'px-2 py-1.5 text-sm font-semibold';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</div>
