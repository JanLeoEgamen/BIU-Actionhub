<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-ui.label for="email" :value="__('Email')" />
            <x-ui.input id="email" class="mt-1" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-ui.label for="password" :value="__('Password')" />

            <x-ui.input id="password" class="mt-1"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <label class="mt-4 flex items-center gap-2">
            <x-ui.checkbox name="remember" :checked="old('remember') === '1'" />
            <span class="text-sm text-muted-foreground">{{ __('Remember me') }}</span>
        </label>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <x-ui.button tag="a" href="{{ route('password.request') }}" variant="link">
                    {{ __('Forgot your password?') }}
                </x-ui.button>
            @endif

            <x-ui.button type="submit" class="ms-3">
                {{ __('Log in') }}
            </x-ui.button>
        </div>
    </form>
</x-guest-layout>