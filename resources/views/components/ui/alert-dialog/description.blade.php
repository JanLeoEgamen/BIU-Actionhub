@php
// Port of mockup/src/components/ui/alert-dialog.tsx — AlertDialogDescription.
$classes = 'text-sm text-muted-foreground';
@endphp

<p {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</p>
