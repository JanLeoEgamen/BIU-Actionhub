@php
// Port of mockup/src/components/ui/alert-dialog.tsx — AlertDialogHeader.
$classes = 'flex flex-col space-y-2 text-center sm:text-left';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</div>
