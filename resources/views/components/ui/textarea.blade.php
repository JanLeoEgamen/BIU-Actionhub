@props(['disabled' => false])

@php
// Port of mockup/src/components/ui/textarea.tsx.
// Bare `disabled` attribute arrives as "" and should count as true.
$disabled = is_string($disabled) ? $disabled !== 'false' : $disabled;

$classes = 'flex min-h-[60px] w-full rounded-md border border-input bg-transparent px-3 py-2 text-base shadow-sm placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm';
@endphp

<textarea
    @disabled($disabled)
    {{ $attributes->merge(['class' => $classes]) }}
>{{ $slot }}</textarea>
