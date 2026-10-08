@php
// Port of mockup/src/components/ui/alert.tsx — AlertTitle.
$classes = 'mb-1 font-medium leading-none tracking-tight';
@endphp

<h5 {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</h5>
