@php
// Port of mockup/src/components/ui/dropdown-menu.tsx — DropdownMenuSeparator.
$classes = '-mx-1 my-1 h-px bg-muted';
@endphp

<div role="separator" {{ $attributes->merge(['class' => $classes]) }}></div>
