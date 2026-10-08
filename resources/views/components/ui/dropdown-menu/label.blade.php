@props(['inset' => false])

@php
// Port of mockup/src/components/ui/dropdown-menu.tsx — DropdownMenuLabel.
$inset = is_string($inset) ? $inset !== 'false' : $inset;

$classes = 'px-2 py-1.5 text-sm font-semibold' . ($inset ? ' pl-8' : '');
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</div>
