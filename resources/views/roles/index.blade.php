<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>

            @can('create roles')
                <a
                    href="{{ route('roles.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                >
                    {{ __('Create Role') }}
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200">

                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        #
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Role
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Permissions
                                    </th>

                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        Users
                                    </th>

                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">

                                @forelse ($roles as $role)

                                    <tr>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $role->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-medium text-gray-900">
                                                {{ $role->name }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-1">

                                                @forelse ($role->permissions as $permission)

                                                    <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">
                                                        {{ $permission->name }}
                                                    </span>

                                                @empty

                                                    <span class="text-gray-500 text-sm">
                                                        No permissions
                                                    </span>

                                                @endforelse

                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $role->users_count }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right">

                                            <div class="flex justify-end gap-2">

                                                @can('view roles')
                                                    <a
                                                        href="{{ route('roles.show', $role) }}"
                                                        class="text-blue-600 hover:text-blue-900"
                                                    >
                                                        View
                                                    </a>
                                                @endcan

                                                @can('edit roles')
                                                    <a
                                                        href="{{ route('roles.edit', $role) }}"
                                                        class="text-indigo-600 hover:text-indigo-900"
                                                    >
                                                        Edit
                                                    </a>
                                                @endcan

                                                @can('delete roles')
                                                    <form
                                                        method="POST"
                                                        action="{{ route('roles.destroy', $role) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this role?');"
                                                    >
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="text-red-600 hover:text-red-900"
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
                                            colspan="5"
                                            class="px-6 py-8 text-center text-gray-500"
                                        >
                                            No roles found.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-6">
                        {{ $roles->links() }}
                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>