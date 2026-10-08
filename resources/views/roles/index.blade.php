<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Roles') }}</h2>
            </div>
            <div>
                @can('create roles')
                    <x-primary-button tag="a" href="{{ route('roles.create') }}">{{ __('Create Role') }}</x-primary-button>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">{{ session('error') }}</div>
            @endif

            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Users</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($roles as $role)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $role->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap"><div class="font-medium text-gray-900">{{ $role->name }}</div></td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-1">
                                                @forelse ($role->permissions as $permission)
                                                    <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">{{ $permission->name }}</span>
                                                @empty
                                                    <span class="text-gray-500 text-sm">{{ __('No permissions') }}</span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $role->users_count }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="flex justify-end gap-2">
                                                @can('view roles')
                                                    <x-primary-button tag="a" href="{{ route('roles.show', $role) }}" size="sm">{{ __('View') }}</x-primary-button>
                                                @endcan
                                                @can('edit roles')
                                                    <x-primary-button tag="a" href="{{ route('roles.edit', $role) }}" size="sm" variant="secondary">{{ __('Edit') }}</x-primary-button>
                                                @endcan
                                                @can('delete roles')
                                                    <form method="POST" action="{{ route('roles.destroy', $role) }}" onsubmit="return confirm('{{ __('Are you sure you want to delete this role?') }}');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-danger-button type="submit" size="sm">{{ __('Delete') }}</x-danger-button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">{{ __('No roles found.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">{{ $roles->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
