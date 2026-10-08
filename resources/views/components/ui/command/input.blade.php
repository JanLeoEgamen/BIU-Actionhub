@props(['placeholder' => 'Type a command or search…'])

@php
// Port of mockup/src/components/ui/command.tsx — CommandInput.
$classes = 'flex h-10 w-full rounded-md bg-transparent py-3 text-sm outline-none placeholder:text-muted-foreground disabled:cursor-not-allowed disabled:opacity-50';
@endphp

<div class="flex items-center border-b px-3">
    <x-ui.icon name="search" class="mr-2 h-5 w-5 shrink-0 opacity-50" />
    <input
        x-model="query"
        x-on:keydown.down.prevent="move(1)"
        x-on:keydown.up.prevent="move(-1)"
        x-on:keydown.enter.prevent="choose()"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => $classes]) }}
    >
</div>
