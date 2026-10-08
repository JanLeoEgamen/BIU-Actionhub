<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-ui.label for="email" :value="__('Email')" />
            <x-ui.input id="email" class="mt-1" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-ui.label for="password" :value="__('Password')" />
            <x-ui.input id="password" class="mt-1" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-ui.label for="password_confirmation" :value="__('Confirm Password')" />

            <x-ui.input id="password_confirmation" class="mt-1" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-ui.button type="submit">
                {{ __('Reset Password') }}
            </x-ui.button>
        </div>
    </form>
</x-guest-layout>