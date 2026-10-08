@php
// Port of mockup/src/components/ui/alert.tsx — AlertDescription.
$classes = 'text-sm [&_p]:leading-relaxed';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</div>
