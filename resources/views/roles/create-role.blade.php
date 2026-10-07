<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Role') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <form
                        method="POST"
                        action="{{ route('roles.store') }}"
                    >

                        @csrf

                        <div>
                            <label
                                for="name"
                                class="block font-medium text-sm text-gray-700"
                            >
                                Role Name
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            >

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mt-6">

                            <h3 class="font-semibold text-gray-900">
                                Permissions
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Select the permissions this role should have.
                            </p>

                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">

                                @forelse ($permissions as $permission)

                                    <label class="flex items-center gap-3 p-3 border rounded-lg hover:bg-gray-50">

                                        <input
                                            type="checkbox"
                                            name="permissions[]"
                                            value="{{ $permission->id }}"
                                            @checked(in_array(
                                                $permission->id,
                                                old('permissions', [])
                                            ))
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                        >

                                        <span class="text-sm text-gray-700">
                                            {{ $permission->name }}
                                        </span>

                                    </label>

                                @empty

                                    <p class="text-gray-500">
                                        No permissions have been created yet.
                                    </p>

                                @endforelse

                            </div>

                            @error('permissions')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        <div class="mt-6 flex items-center gap-3">

                            <a
                                href="{{ route('roles.index') }}"
                                class="px-4 py-2 bg-gray-100 rounded-md text-gray-700 hover:bg-gray-200"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
                            >
                                Create Role
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>