@php
// Port of mockup/src/components/ui/command.tsx — CommandShortcut.
$classes = 'ml-auto text-xs tracking-widest text-muted-foreground';
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</span>
