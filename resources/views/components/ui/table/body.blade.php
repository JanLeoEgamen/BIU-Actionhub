@php
// Port of mockup/src/components/ui/table.tsx — TableBody.
$classes = '[&_tr:last-child]:border-0';
@endphp

<tbody {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</tbody>
