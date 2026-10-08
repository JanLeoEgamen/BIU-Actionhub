<x-guest-layout>
    <x-ui.alert class="mb-4">
        <x-ui.alert.description>
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </x-ui.alert.description>
    </x-ui.alert>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-ui.label for="email" :value="__('Email')" />
            <x-ui.input id="email" class="mt-1" type="email" name="email" value="{{ old('email') }}" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-ui.button type="submit">
                {{ __('Email Password Reset Link') }}
            </x-ui.button>
        </div>
    </form>
</x-guest-layout>