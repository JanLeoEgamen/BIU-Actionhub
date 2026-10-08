<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-ui.alert>
                <x-ui.icon name="check" />
                <div>
                    <x-ui.alert.title>{{ __('Dashboard') }}</x-ui.alert.title>
                    <x-ui.alert.description>{{ __("You're logged in!") }}</x-ui.alert.description>
                </div>
            </x-ui.alert>
        </div>
    </div>
</x-app-layout>