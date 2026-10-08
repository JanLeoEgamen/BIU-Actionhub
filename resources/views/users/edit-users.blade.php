<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-card shadow-sm rounded-xl border">
                <div class="p-6 space-y-6">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <x-ui.label for="name" :value="__('Name')" required />
                                <x-ui.input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required class="mt-1" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <x-ui.label for="email" :value="__('Email')" required />
                                <x-ui.input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="mt-1" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <x-ui.label for="password" :value="__('New Password')" />
                                <x-ui.input id="password" name="password" type="password" class="mt-1" />
                                <p class="text-sm text-muted-foreground mt-1">{{ __('Leave blank to keep the current password.') }}</p>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div>
                                <x-ui.label for="password_confirmation" :value="__('Confirm New Password')" />
                                <x-ui.input id="password_confirmation" name="password_confirmation" type="password" class="mt-1" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-sm font-medium text-foreground">Roles</h3>
                            <div class="mt-3 space-y-3">
                                @foreach ($roles as $role)
                                    <label class="flex items-center gap-3">
                                        <x-ui.checkbox
                                            name="roles[]"
                                            :value="$role->id"
                                            :checked="in_array($role->id, old('roles', $user->roles->pluck('id')->toArray()))"
                                        />
                                        <span class="text-sm text-muted-foreground">{{ $role->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <x-ui.button tag="a" href="{{ route('users.index') }}" variant="outline" class="flex-1">{{ __('Cancel') }}</x-ui.button>
                            <x-ui.button type="submit" class="flex-1">{{ __('Update User') }}</x-ui.button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>