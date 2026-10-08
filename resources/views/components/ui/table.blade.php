@php
// Port of mockup/src/components/ui/table.tsx — Table (wraps in an overflow container).
$classes = 'w-full caption-bottom text-sm';
@endphp

<div class="relative w-full overflow-auto">
    <table {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</table>
</div>
