@props([
    'align' => 'center',
    'width' => 'w-72',
])

@php
// Port of mockup/src/components/ui/popover.tsx — Alpine.js version.
// Flat API: trigger through the named `trigger` slot, panel as the default slot.
$alignmentClasses = match ($align) {
    'left' => 'start-0',
    'right' => 'end-0',
    default => 'left-1/2 -translate-x-1/2',
};

$contentClasses = 'z-50 rounded-md border bg-popover p-4 text-popover-foreground shadow-md outline-none';
@endphp

<div
    class="relative"
    x-data="{ open: false }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
    @close.stop="open = false"
    {{ $attributes }}
>
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        x-cloak
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute mt-1 {{ $width }} {{ $alignmentClasses }} {{ $contentClasses }}"
        style="display: none;"
    >
        {{ $slot }}
    </div>
</div>
