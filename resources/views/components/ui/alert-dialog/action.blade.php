@props(['type' => 'button'])

@php
// Port of mockup/src/components/ui/alert-dialog.tsx — AlertDialogAction
// (buttonVariants() default variant; closes the enclosing alert-dialog).
$classes = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium cursor-pointer transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 disabled:cursor-not-allowed [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 h-9 px-4 py-2 bg-primary text-primary-foreground shadow hover:bg-primary/90';
@endphp

<button
    type="{{ $type }}"
    x-on:click="show = false"
    {{ $attributes->merge(['class' => $classes]) }}
>{{ $slot }}</button>
