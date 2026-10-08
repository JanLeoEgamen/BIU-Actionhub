@php
// Port of mockup/src/components/ui/table.tsx — TableHead.
$classes = 'h-10 px-2 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0 [&>[role=checkbox]]:translate-y-[2px]';
@endphp

<th {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</th>
