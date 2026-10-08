@props([
    'name' => null,
    'checked' => false,
    'value' => '1',
    'disabled' => false,
])

@php
// Port of mockup/src/components/ui/checkbox.tsx — Alpine.js version.
// When `name` is given, a hidden "0" input is emitted so unchecked boxes still
// submit (standard Laravel hidden-input convention). Array names (ending in
// "[]") skip it: unchecked entries are simply omitted, since a stray "0" would
// fail `exists:…,id` array validation rules (e.g. roles[], permissions[]).
// Indeterminate state is not supported (Radix-only feature).
$checked = $checked !== false && $checked !== null && $checked !== 'false';
$disabled = is_string($disabled) ? $disabled !== 'false' : $disabled;
$isArrayName = $name !== null && str_ends_with($name, '[]');

$boxClasses = 'pointer-events-none grid h-4 w-4 shrink-0 place-content-center rounded-sm border border-primary shadow transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground';
@endphp

<span class="relative inline-flex h-4 w-4 items-center" x-data="{ checked: @js($checked) }">
    @if ($name && ! $isArrayName)
        <input type="hidden" name="{{ $name }}" value="0">
    @endif

    <input
        type="checkbox"
        @if ($name) name="{{ $name }}" @endif
        value="{{ $value }}"
        x-model="checked"
        @disabled($disabled)
        aria-checked="false"
        x-bind:aria-checked="checked ? 'true' : 'false'"
        class="peer absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0 disabled:cursor-not-allowed disabled:opacity-50"
    >

    <span x-bind:data-state="checked ? 'checked' : 'unchecked'" class="{{ $boxClasses }}">
        <x-ui.icon name="check" class="h-3.5 w-3.5" x-show="checked" x-cloak />
    </span>
</span>
