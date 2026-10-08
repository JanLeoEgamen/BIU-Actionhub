@php
// Port of mockup/src/components/ui/sheet.tsx — SheetTitle.
$classes = 'text-lg font-semibold text-foreground';
@endphp

<h2
    x-init="(() => { const root = $el.closest('[data-sheet-name]'); if (root) $el.id = root.dataset.sheetName + '-sheet-title'; })()"
    {{ $attributes->merge(['class' => $classes]) }}
>{{ $slot }}</h2>
