<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <form
                        method="POST"
                        action="{{ route('users.store') }}"
                    >

                        @csrf

                        <div>

                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Name
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div class="mt-4">

                            <label
                                for="email"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Email
                            </label>

                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                            @error('email')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div class="mt-4">

                            <label
                                for="password"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Password
                            </label>

                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                            @error('password')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div class="mt-4">

                            <label
                                for="password_confirmation"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Confirm Password
                            </label>

                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>

                        <div class="mt-6">

                            <h3 class="font-medium text-gray-900">
                                Roles
                            </h3>

                            <div class="mt-3 space-y-2">

                                @forelse ($roles as $role)

                                    <label class="flex items-center gap-3">

                                        <input
                                            type="checkbox"
                                            name="roles[]"
                                            value="{{ $role->id }}"
                                            @checked(
                                                in_array(
                                                    $role->id,
                                                    old('roles', [])
                                                )
                                            )
                                            class="rounded border-gray-300"
                                        >

                                        <span>
                                            {{ $role->name }}
                                        </span>

                                    </label>

                                @empty

                                    <p class="text-gray-500">
                                        No roles available.
                                    </p>

                                @endforelse

                            </div>

                        </div>

                        <div class="mt-6 flex gap-3">

                            <a
                                href="{{ route('users.index') }}"
                                class="px-4 py-2 bg-gray-100 rounded-md"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="px-4 py-2 bg-gray-800 text-white rounded-md"
                            >
                                Create User
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>