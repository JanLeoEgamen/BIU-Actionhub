<x-guest-layout>
    <x-ui.alert class="mb-4">
        <x-ui.alert.description>
            {{ __("Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.") }}
        </x-ui.alert.description>
    </x-ui.alert>

    @if (session('status') == 'verification-link-sent')
        <x-ui.alert class="mb-4 border-success/50 bg-success/10">
            <x-ui.icon name="check" />
            <div>
                <x-ui.alert.description>
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </x-ui.alert.description>
            </div>
        </x-ui.alert>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-ui.button type="submit">
                    {{ __('Resend Verification Email') }}
                </x-ui.button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-ui.button type="submit" variant="link">
                {{ __('Log Out') }}
            </x-ui.button>
        </form>
    </div>
</x-guest-layout>