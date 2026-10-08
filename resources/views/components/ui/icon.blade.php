@props([
    'name',
    'size' => 'h-4 w-4',
])

@php
// Inline lucide-react icon paths (MIT licensed) — keeps the project free of
// extra icon dependencies. Add entries here as more icons are needed.
$icons = [
    'x' => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
    'check' => '<path d="M20 6 9 17l-5-5"/>',
    'chevron-down' => '<path d="m6 9 6 6 6-6"/>',
    'chevron-up' => '<path d="m18 15-6-6-6 6"/>',
    'chevron-right' => '<path d="m9 18 6-6-6-6"/>',
    'search' => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
    'circle' => '<circle cx="12" cy="12" r="10"/>',
];

$body = $icons[$name] ?? '';
@endphp

<svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
    {{ $attributes->merge(['class' => $size]) }}
>{!! $body !!}
</svg>
