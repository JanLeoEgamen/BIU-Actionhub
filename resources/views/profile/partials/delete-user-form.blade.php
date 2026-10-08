<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-foreground">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-muted-foreground">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-ui.button
        variant="destructive"
        x-on:click.prevent="$dispatch('open-dialog', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-ui.button>

    <x-ui.alert-dialog name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()">
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <x-ui.alert-dialog.header>
                <x-ui.alert-dialog.title>
                    {{ __('Are you sure you want to delete your account?') }}
                </x-ui.alert-dialog.title>

                <x-ui.alert-dialog.description>
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </x-ui.alert-dialog.description>
            </x-ui.alert-dialog.header>

            <div class="mt-4">
                <x-ui.label for="password" :value="__('Password')" class="sr-only" />

                <x-ui.input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <x-ui.alert-dialog.footer class="mt-6">
                <x-ui.alert-dialog.cancel>{{ __('Cancel') }}</x-ui.alert-dialog.cancel>

                <x-ui.alert-dialog.action type="submit">
                    {{ __('Delete Account') }}
                </x-ui.alert-dialog.action>
            </x-ui.alert-dialog.footer>
        </form>
    </x-ui.alert-dialog>
</section>