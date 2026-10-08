<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-xl border border-gray-200">

                <div class="p-6 space-y-6">

                    <form method="POST" action="{{ route('users.store') }}">

                        @csrf

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="name" :value="__('Name')" required />
                                <x-text-input
                                    id="name"
                                    name="name"
                                    type="text"
                                    :value="old('name')"
                                    required
                                    class="mt-1"
                                />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" required />
                                <x-text-input
                                    id="email"
                                    name="email"
                                    type="email"
                                    :value="old('email')"
                                    required
                                    class="mt-1"
                                />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('Password')" required />
                                <x-text-input
                                    id="password"
                                    name="password"
                                    type="password"
                                    required
                                    class="mt-1"
                                />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" required />
                                <x-text-input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    required
                                    class="mt-1"
                                />
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-sm font-medium text-gray-900">Roles</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Assign one or more roles to the user.
                            </p>
                            <div class="mt-3 space-y-3">
                                @forelse ($roles as $role)
                                    <label class="flex items-center gap-3">
                                        <input
                                            type="checkbox"
                                            name="roles[]"
                                            value="{{ $role->id }}"
                                            @checked(in_array($role->id, old('roles', [])))
                                            class="rounded border-gray-300"
                                        >
                                        <span class="text-sm text-gray-700">
                                            {{ $role->name }}
                                        </span>
                                    </label>
                                @empty
                                    <p class="text-sm text-gray-500">
                                        {{ __('No roles available.') }}
                                    </p>
                                @endforelse
                            </div>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <x-secondary-button tag="a" href="{{ route('users.index') }}" class="flex-1">
                                {{ __('Cancel') }}
                            </x-secondary-button>
                            <x-primary-button class="flex-1">
                                {{ __('Create User') }}
                            </x-primary-button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
