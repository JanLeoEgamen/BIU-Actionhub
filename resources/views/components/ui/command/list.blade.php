@php
// Port of mockup/src/components/ui/command.tsx — CommandList.
$classes = 'max-h-[300px] overflow-y-auto overflow-x-hidden';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</div>
