@php
// Port of mockup/src/components/ui/alert-dialog.tsx — AlertDialogTitle.
$classes = 'text-lg font-semibold';
@endphp

<h2
    x-init="(() => { const root = $el.closest('[data-dialog-name]'); if (root) $el.id = root.dataset.dialogName + '-dialog-title'; })()"
    {{ $attributes->merge(['class' => $classes]) }}
>{{ $slot }}</h2>
