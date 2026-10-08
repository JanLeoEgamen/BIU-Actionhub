@props([
    'name',
    'show' => false,
    'side' => 'right',
])

@php
// Port of mockup/src/components/ui/sheet.tsx — Alpine.js version with
// side-aware positioning and slide transitions.
$sideClasses = [
    'top' => 'inset-x-0 top-0 border-b',
    'bottom' => 'inset-x-0 bottom-0 border-t',
    'left' => 'inset-y-0 left-0 h-full w-3/4 border-r sm:max-w-sm',
    'right' => 'inset-y-0 right-0 h-full w-3/4 border-l sm:max-w-sm',
];

$enterStart = [
    'top' => '-translate-y-full',
    'bottom' => 'translate-y-full',
    'left' => '-translate-x-full',
    'right' => 'translate-x-full',
][$side] ?? 'translate-x-full';

$leaveEnd = $enterStart;

$panelClasses = 'fixed z-50 gap-4 bg-background p-6 shadow-lg transition ease-in-out duration-300 ' . ($sideClasses[$side] ?? $sideClasses['right']);
@endphp

<div
    x-data="{ show: @js($show) }"
    x-init="$watch('show', value => document.body.classList.toggle('overflow-y-hidden', value))"
    x-on:open-sheet.window="$event.detail === '{{ $name }}' ? show = true : null"
    x-on:close-sheet.window="$event.detail === '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    data-sheet-name="{{ $name }}"
    class="fixed inset-0 z-50"
    style="display: none;"
    {{ $attributes }}
>
    <div
        x-show="show"
        class="fixed inset-0 bg-black/80"
        x-on:click="show = false"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    ></div>

    <div
        x-show="show"
        role="dialog"
        aria-modal="true"
        aria-labelledby="{{ $name }}-sheet-title"
        class="{{ $panelClasses }}"
        x-transition:enter="ease-in-out duration-300"
        x-transition:enter-start="{{ $enterStart }}"
        x-transition:enter-end="translate-x-0 translate-y-0"
        x-transition:leave="ease-in-out duration-300"
        x-transition:leave-start="translate-x-0 translate-y-0"
        x-transition:leave-end="{{ $leaveEnd }}"
    >
        <button
            type="button"
            x-on:click="show = false"
            class="absolute right-4 top-4 rounded-sm opacity-70 ring-offset-background cursor-pointer transition-opacity hover:opacity-100 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:pointer-events-none"
        >
            <x-ui.icon name="x" class="h-4 w-4" />
            <span class="sr-only">Close</span>
        </button>

        {{ $slot }}
    </div>
</div>
