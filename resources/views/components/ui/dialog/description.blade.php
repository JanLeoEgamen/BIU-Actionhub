@php
// Port of mockup/src/components/ui/dialog.tsx — DialogDescription.
$classes = 'text-sm text-muted-foreground';
@endphp

<p {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</p>
