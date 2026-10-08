@php
// Port of mockup/src/components/ui/dialog.tsx — DialogTitle.
// The id is adopted from the enclosing <x-ui.dialog> root so the panel's
// aria-labelledby always points at this element.
$classes = 'text-lg font-semibold leading-none tracking-tight';
@endphp

<h2
    x-init="(() => { const root = $el.closest('[data-dialog-name]'); if (root) $el.id = root.dataset.dialogName + '-dialog-title'; })()"
    {{ $attributes->merge(['class' => $classes]) }}
>{{ $slot }}</h2>
