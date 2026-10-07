<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $role->name }}
            </h2>

            @can('edit roles')
                <a
                    href="{{ route('roles.edit', $role) }}"
                    class="px-4 py-2 bg-gray-800 text-white rounded-md"
                >
                    Edit Role
                </a>
            @endcan

        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="font-semibold text-lg">
                        Role Information
                    </h3>

                    <div class="mt-4">
                        <p>
                            <strong>Name:</strong>
                            {{ $role->name }}
                        </p>

                        <p class="mt-2">
                            <strong>Guard:</strong>
                            {{ $role->guard_name }}
                        </p>
                    </div>

                </div>

            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="font-semibold text-lg">
                        Permissions
                    </h3>

                    <div class="mt-4 flex flex-wrap gap-2">

                        @forelse ($role->permissions as $permission)

                            <span class="px-3 py-1 rounded-full bg-gray-100 text-sm">
                                {{ $permission->name }}
                            </span>

                        @empty

                            <span class="text-gray-500">
                                No permissions assigned.
                            </span>

                        @endforelse

                    </div>

                </div>

            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="font-semibold text-lg">
                        Users With This Role
                    </h3>

                    <div class="mt-4 overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                        Name
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs uppercase text-gray-500">
                                        Email
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
                                    </tr>

                                @empty

                                    <tr>
                                        <td
                                            colspan="2"
                                            class="px-6 py-6 text-center text-gray-500"
                                        >
                                            No users have this role.
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