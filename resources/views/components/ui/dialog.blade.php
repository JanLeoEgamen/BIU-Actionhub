@props([
    'name',
    'show' => false,
    'maxWidth' => 'lg',
    'contentClass' => 'p-6',
])

@php
// Port of mockup/src/components/ui/dialog.tsx — implemented with Alpine.js
// (mirrors the focus-trap/event behaviour of the existing Breeze x-modal).
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth] ?? 'sm:max-w-lg';

$panelClasses = 'relative grid w-full gap-4 border bg-background shadow-lg duration-200 sm:mx-auto sm:rounded-lg ' . $maxWidth . ' ' . $contentClass;
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)].filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1 },
    }"
    x-init="$watch('show', value => {
        document.body.classList.toggle('overflow-y-hidden', value);
        {{ $attributes->has('focusable') ? "if (value) setTimeout(() => { const f = firstFocusable(); if (f) f.focus() }, 100)" : '' }}
    })"
    x-on:open-dialog.window="$event.detail === '{{ $name }}' ? show = true : null"
    x-on:close-dialog.window="$event.detail === '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    data-dialog-name="{{ $name }}"
    class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0"
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
        aria-labelledby="{{ $name }}-dialog-title"
        class="{{ $panelClasses }} mb-6"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
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
