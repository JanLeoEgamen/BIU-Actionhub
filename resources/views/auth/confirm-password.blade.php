<x-guest-layout>
    <x-ui.alert class="mb-4">
        <x-ui.alert.description>
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </x-ui.alert.description>
    </x-ui.alert>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-ui.label for="password" :value="__('Password')" />

            <x-ui.input id="password" class="mt-1"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-ui.button type="submit">
                {{ __('Confirm') }}
            </x-ui.button>
        </div>
    </form>
</x-guest-layout>