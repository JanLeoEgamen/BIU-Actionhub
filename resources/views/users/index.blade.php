<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>

            @can('create users')
                <a
                    href="{{ route('users.create') }}"
                    class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm"
                >
                    Create User
                </a>
            @endcan

        </div>

    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))

                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>

            @endif

            @if (session('error'))

                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>

            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead>

                                <tr>

                                    <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                        Name
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                        Email
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                        Roles
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs uppercase text-gray-500">
                                        Actions
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200">

                                @forelse ($users as $user)

                                    <tr>

                                        <td class="px-6 py-4">
                                            {{ $user->name }}
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $user->email }}
                                        </td>

                                        <td class="px-6 py-4">

                                            <div class="flex flex-wrap gap-1">

                                                @forelse ($user->roles as $role)

                                                    <span class="px-2 py-1 text-xs bg-gray-100 rounded">
                                                        {{ $role->name }}
                                                    </span>

                                                @empty

                                                    <span class="text-sm text-gray-500">
                                                        No roles
                                                    </span>

                                                @endforelse

                                            </div>

                                        </td>

                                        <td class="px-6 py-4">

                                            <div class="flex justify-end gap-3">

                                                @can('view users')
                                                    <a
                                                        href="{{ route('users.show', $user) }}"
                                                        class="text-blue-600"
                                                    >
                                                        View
                                                    </a>
                                                @endcan

                                                @can('edit users')
                                                    <a
                                                        href="{{ route('users.edit', $user) }}"
                                                        class="text-indigo-600"
                                                    >
                                                        Edit
                                                    </a>
                                                @endcan

                                                @can('delete users')

                                                    <form
                                                        method="POST"
                                                        action="{{ route('users.destroy', $user) }}"
                                                        onsubmit="return confirm('Delete this user?');"
                                                    >

                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="text-red-600"
                                                        >
                                                            Delete
                                                        </button>

                                                    </form>

                                                @endcan

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="4"
                                            class="px-6 py-8 text-center text-gray-500"
                                        >
                                            No users found.
                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>