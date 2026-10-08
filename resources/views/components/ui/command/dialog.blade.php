@props([
    'name',
    'show' => false,
    'maxWidth' => 'lg',
    'placeholder' => 'Type a command or search…',
    'emptyText' => 'No results found.',
])

@php
// Port of mockup/src/components/ui/command.tsx — CommandDialog.
// A dialog hosting the command palette (the Cmd+K search in the app shell).
// Pass items/groups through the default slot.
@endphp

<x-ui.dialog :name="$name" :show="$show" :max-width="$maxWidth" content-class="p-0 overflow-hidden">
    <x-ui.command>
        <x-ui.command.input :placeholder="$placeholder" />
        <x-ui.command.list>
            <x-ui.command.empty>{{ $emptyText }}</x-ui.command.empty>
            {{ $slot }}
        </x-ui.command.list>
    </x-ui.command>
</x-ui.dialog>
