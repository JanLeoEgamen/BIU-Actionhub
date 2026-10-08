@props([
    'disabled' => false,
    'inset' => false,
])

@php
// Port of mockup/src/components/ui/dropdown-menu.tsx — DropdownMenuItem.
$disabled = is_string($disabled) ? $disabled !== 'false' : $disabled;
$inset = is_string($inset) ? $inset !== 'false' : $inset;

$classes = 'relative flex cursor-default select-none items-center gap-2 rounded-sm px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 text-left w-full'
    . ($inset ? ' pl-8' : '');
@endphp

<button
    type="button"
    role="menuitem"
    @disabled($disabled)
    {{ $attributes->merge(['class' => $classes]) }}
>{{ $slot }}</button>
