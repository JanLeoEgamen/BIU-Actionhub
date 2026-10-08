@php
// Port of mockup/src/components/ui/table.tsx — TableCaption.
$classes = 'mt-4 text-sm text-muted-foreground';
@endphp

<caption {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</caption>
