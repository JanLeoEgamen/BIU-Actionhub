@php
// Port of mockup/src/components/ui/sheet.tsx — SheetDescription.
$classes = 'text-sm text-muted-foreground';
@endphp

<p {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</p>
