@php
// Port of mockup/src/components/ui/table.tsx — TableCell.
$classes = 'p-2 align-middle [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]';
@endphp

<td {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</td>
