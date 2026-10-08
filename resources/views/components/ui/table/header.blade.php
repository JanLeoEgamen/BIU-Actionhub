@php
// Port of mockup/src/components/ui/table.tsx — TableHeader.
$classes = '[&_tr]:border-b';
@endphp

<thead {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</thead>
