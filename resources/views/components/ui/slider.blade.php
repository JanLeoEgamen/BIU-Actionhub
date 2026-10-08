@props([
    'name' => null,
    'value' => 0,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'disabled' => false,
])

@php
// Port of mockup/src/components/ui/slider.tsx — single-thumb Alpine version.
// A visually hidden native range input handles a11y/keyboard/forms while the
// track and thumb are rendered for the shadcn look. Multi-thumb sliders
// (Radix-only) are not supported.
$disabled = is_string($disabled) ? $disabled !== 'false' : $disabled;
$initial = $name ? old($name, $value) : $value;
@endphp

<div
    class="relative flex w-full touch-none select-none items-center"
    x-data="{
        value: {{ json_encode($initial + 0) }},
        focused: false,
        get pct() {
            const range = ({{ (float) $max }}) - ({{ (float) $min }});
            return range === 0 ? 0 : Math.min(100, Math.max(0, ((this.value - ({{ (float) $min }})) / range) * 100));
        },
    }"
    {{ $attributes }}
>
    <div class="relative h-1.5 w-full grow overflow-hidden rounded-full bg-primary/20">
        <div class="absolute h-full rounded-full bg-primary" x-bind:style="'width: ' + pct + '%'"></div>
    </div>

    <div
        class="pointer-events-none absolute top-1/2 h-4 w-4 -translate-x-1/2 -translate-y-1/2 rounded-full border border-primary/50 bg-background shadow transition-colors"
        :class="focused ? 'ring-1 ring-ring' : ''"
        x-bind:style="'left: calc((100% - 16px) * ' + (pct / 100) + ' + 8px)'"
    ></div>

    <input
        type="range"
        @if ($name) name="{{ $name }}" @endif
        min="{{ $min }}"
        max="{{ $max }}"
        step="{{ $step }}"
        x-model.number="value"
        x-on:focus="focused = true"
        x-on:blur="focused = false"
        @disabled($disabled)
        class="absolute inset-0 h-full w-full cursor-pointer appearance-none bg-transparent opacity-0 disabled:cursor-not-allowed"
    >
</div>
