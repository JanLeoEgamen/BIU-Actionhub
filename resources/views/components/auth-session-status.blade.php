@props(['status'])

@if ($status)
    <div {{ $attributes }}>
        <x-ui.alert>
            <x-ui.alert.description>{{ $status }}</x-ui.alert.description>
        </x-ui.alert>
    </div>
@endif