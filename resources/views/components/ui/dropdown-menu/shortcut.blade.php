@php
// Port of mockup/src/components/ui/dropdown-menu.tsx — DropdownMenuShortcut.
$classes = 'ml-auto text-xs tracking-widest opacity-60';
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</span>
