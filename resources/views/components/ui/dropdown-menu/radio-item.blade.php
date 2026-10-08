@props([
    'checked' => false,
    'disabled' => false,
])

@php
// Port of mockup/src/components/ui/dropdown-menu.tsx — DropdownMenuRadioItem.
// Toggles local Alpine state (pair several items manually for group behaviour).
$checked = $checked !== false && $checked !== null && $checked !== 'false';
$disabled = is_string($disabled) ? $disabled !== 'false' : $disabled;

$classes = 'relative flex cursor-default select-none items-center rounded-sm py-1.5 pl-8 pr-2 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50 text-left w-full';
@endphp

<div x-data="{ checked: @js($checked) }">
    <button
        type="button"
        role="menuitemradio"
        :aria-checked="checked ? 'true' : 'false'"
        @disabled($disabled)
        x-on:click="checked = true"
        {{ $attributes->merge(['class' => $classes]) }}
    >
        <span class="absolute left-2 flex h-3.5 w-3.5 items-center justify-center" x-show="checked" x-cloak>
            <x-ui.icon name="circle" class="h-2 w-2 fill-current" />
        </span>
        {{ $slot }}
    </button>
</div>
