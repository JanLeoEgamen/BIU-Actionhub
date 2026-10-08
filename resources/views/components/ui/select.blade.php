@props([
    'name' => null,
    'value' => null,
    'placeholder' => 'Select an option',
    'disabled' => false,
])

@php
// Port of mockup/src/components/ui/select.tsx — Alpine.js listbox.
// Flat API: the root renders the trigger; pass <x-ui.select.item> children as
// the default slot. A hidden input carries the value back with the form.
$disabled = is_string($disabled) ? $disabled !== 'false' : $disabled;

$triggerClasses = 'flex h-9 w-full items-center justify-between whitespace-nowrap rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm ring-offset-background cursor-pointer data-[placeholder]:text-muted-foreground focus:outline-none focus:ring-1 focus:ring-ring disabled:cursor-not-allowed disabled:opacity-50 [&>span]:line-clamp-1';
@endphp

<div
    class="relative"
    x-data="{
        open: false,
        value: @js($value ?? ''),
        label: '',
        init() {
            this.$nextTick(() => {
                const item = [...this.$el.querySelectorAll('[data-select-item]')]
                    .find(el => el.dataset.value === String(this.value));
                this.label = item ? item.dataset.label : '';
            });
        },
        select(value, label) {
            this.value = value;
            this.label = label;
            this.open = false;
            this.$dispatch('select-change', { name: @js($name), value });
        },
    }"
    {{ $attributes }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" x-model="value">
    @endif

    <button
        type="button"
        role="combobox"
        aria-haspopup="listbox"
        :aria-expanded="open ? 'true' : 'false'"
        x-on:click="open = ! open"
        x-on:keydown.escape.window="open = false"
        @disabled($disabled)
        :data-state="open ? 'open' : 'closed'"
        :data-placeholder="label ? null : 'placeholder'"
        class="{{ $triggerClasses }}"
    >
        <span
            x-text="label || {{ json_encode($placeholder) }}"
            :class="label ? 'text-foreground' : 'text-muted-foreground'"
        ></span>
        <span class="inline-flex shrink-0" x-bind:class="open ? 'rotate-180' : ''">
            <x-ui.icon name="chevron-down" class="h-4 w-4 opacity-50 transition-transform" />
        </span>
    </button>

    <div
        x-show="open"
        x-cloak
        x-on:click.outside="open = false"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        role="listbox"
        class="absolute z-50 mt-1 max-h-72 w-full min-w-[8rem] overflow-y-auto overflow-x-hidden rounded-md border bg-popover p-1 text-popover-foreground shadow-md"
        style="display: none;"
    >
        {{ $slot }}
    </div>
</div>
