@props(['keywords' => null])

@php
// Port of mockup/src/components/ui/command.tsx — CommandItem.
// `keywords` defaults to the slot text and drives client-side filtering.
// No click handler is emitted so you can pass your own x-on:click / @click;
// Arrow/Enter navigation is provided by the command root.
$cmdText = $keywords ?? trim(strip_tags((string) $slot));

$classes = 'relative flex cursor-default gap-2 select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none data-[disabled=true]:pointer-events-none data-[active=true]:bg-accent data-[active=true]:text-accent-foreground data-[disabled=true]:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0';
@endphp

<div
    role="option"
    data-cmd-item
    data-cmd="{{ $cmdText }}"
    data-active="false"
    {{ $attributes->merge(['class' => $classes]) }}
>{{ $slot }}</div>
