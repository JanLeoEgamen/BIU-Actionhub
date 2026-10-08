@php
// Port of mockup/src/components/ui/table.tsx — TableFooter.
$classes = 'border-t bg-muted/50 font-medium [&>tr]:last:border-b-0';
@endphp

<tfoot {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</tfoot>
