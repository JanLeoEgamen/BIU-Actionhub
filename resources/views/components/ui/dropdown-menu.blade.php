@props([
    'align' => 'right',
    'width' => '48',
])

@php
// Port of mockup/src/components/ui/dropdown-menu.tsx — Alpine.js version.
// Flat API (like the existing Breeze x-dropdown): pass the trigger through
// the named `trigger` slot, menu items as the default slot.
$alignmentClasses = match ($align) {
    'left' => 'start-0',
    'right' => 'end-0',
    'center' => 'left-1/2 -translate-x-1/2',
    default => 'end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    default => $width,
};

$contentClasses = 'z-50 min-w-[8rem] overflow-y-auto overflow-x-hidden rounded-md border bg-popover p-1 text-popover-foreground shadow-md';
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
        @click="open = false"
    >
        {{ $slot }}
    </div>
</div>
