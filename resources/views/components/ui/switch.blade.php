@props([
    'name' => null,
    'checked' => false,
    'value' => '1',
    'disabled' => false,
])

@php
// Port of mockup/src/components/ui/switch.tsx — Alpine.js version.
// When `name` is given, a hidden "0" input is emitted so unchecked switches
// still submit (standard Laravel hidden-input convention).
$checked = $checked !== false && $checked !== null && $checked !== 'false';
$disabled = is_string($disabled) ? $disabled !== 'false' : $disabled;

$trackClasses = 'peer inline-flex h-5 w-9 shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent shadow-sm transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=unchecked]:bg-input';
$thumbClasses = 'pointer-events-none block h-4 w-4 rounded-full bg-background shadow-lg ring-0 transition-transform data-[state=checked]:translate-x-4 data-[state=unchecked]:translate-x-0';
@endphp

<span class="relative inline-flex items-center" x-data="{ checked: @js($checked) }">
    @if ($name)
        <input type="hidden" name="{{ $name }}" value="0">
    @endif

    <input
        type="checkbox"
        role="switch"
        @if ($name) name="{{ $name }}" @endif
        value="{{ $value }}"
        x-model="checked"
        @disabled($disabled)
        aria-checked="false"
        x-bind:aria-checked="checked ? 'true' : 'false'"
        class="peer absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0 disabled:cursor-not-allowed disabled:opacity-50"
    >

    <span
        x-bind:data-state="checked ? 'checked' : 'unchecked'"
        class="{{ $trackClasses }}"
    >
        <span x-bind:data-state="checked ? 'checked' : 'unchecked'" class="{{ $thumbClasses }}"></span>
    </span>
</span>
