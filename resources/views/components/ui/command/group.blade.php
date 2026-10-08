@props(['heading' => null])

@php
// Port of mockup/src/components/ui/command.tsx — CommandGroup.
// data-cmd-group lets the root hide the whole group when all items filter out.
$classes = 'overflow-hidden p-1 text-foreground';
@endphp

<div role="group" data-cmd-group {{ $attributes->merge(['class' => $classes]) }}>
    @if ($heading)
        <div class="px-2 py-1.5 text-xs font-medium text-muted-foreground">{{ $heading }}</div>
    @endif
    {{ $slot }}
</div>
