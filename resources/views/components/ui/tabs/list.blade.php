@php
// Port of mockup/src/components/ui/tabs.tsx — TabsList.
$classes = 'inline-flex h-9 items-center justify-center rounded-lg bg-muted p-1 text-muted-foreground';
@endphp

<div role="tablist" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</div>
