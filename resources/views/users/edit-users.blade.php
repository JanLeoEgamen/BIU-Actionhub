<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>

    </x-slot>

    <div class="py-12">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <form
                        method="POST"
                        action="{{ route('users.update', $user) }}"
                    >

                        @csrf
                        @method('PUT')

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
                                value="{{ old('name', $user->name) }}"
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
                                value="{{ old('email', $user->email) }}"
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
                                New Password
                            </label>

                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                            <p class="mt-1 text-sm text-gray-500">
                                Leave blank to keep the current password.
                            </p>

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
                                Confirm New Password
                            </label>

                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >

                        </div>

                        <div class="mt-6">

                            <h3 class="font-medium text-gray-900">
                                Roles
                            </h3>

                            <div class="mt-3 space-y-2">

                                @foreach ($roles as $role)

                                    <label class="flex items-center gap-3">

                                        <input
                                            type="checkbox"
                                            name="roles[]"
                                            value="{{ $role->id }}"
                                            @checked(
                                                in_array(
                                                    $role->id,
                                                    old(
                                                        'roles',
                                                        $user->roles->pluck('id')->toArray()
                                                    )
                                                )
                                            )
                                            class="rounded border-gray-300"
                                        >

                                        <span>
                                            {{ $role->name }}
                                        </span>

                                    </label>

                                @endforeach

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
                                Update User
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>