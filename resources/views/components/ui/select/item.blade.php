@props([
    'value',
    'label' => null,
    'disabled' => false,
])

@php
// Port of mockup/src/components/ui/select.tsx — SelectItem.
// `label` defaults to the slot's text and is used by the trigger display and
// for value -> label resolution on init (old()/repopulated forms).
$disabled = is_string($disabled) ? $disabled !== 'false' : $disabled;
$itemLabel = $label ?? trim(strip_tags((string) $slot));

$classes = 'relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-2 pr-8 text-sm outline-none focus:bg-accent focus:text-accent-foreground data-[state=selected]:bg-accent data-[state=selected]:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50 text-left';
@endphp

<button
    type="button"
    role="option"
    data-select-item
    data-value="{{ $value }}"
    data-label="{{ $itemLabel }}"
    @disabled($disabled)
    x-on:click="select({{ json_encode((string) $value) }}, {{ json_encode($itemLabel) }})"
    :data-state="String(value) === {{ json_encode((string) $value) }} ? 'selected' : 'idle'"
    {{ $attributes->merge(['class' => $classes]) }}
>
    <span
        class="absolute right-2 flex h-3.5 w-3.5 items-center justify-center"
        x-show="String(value) === {{ json_encode((string) $value) }}"
        x-cloak
    >
        <x-ui.icon name="check" class="h-4 w-4" />
    </span>
    {{ $slot }}
</button>
