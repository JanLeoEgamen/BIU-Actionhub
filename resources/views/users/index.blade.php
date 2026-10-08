<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Users') }}</h2>
            </div>
            <div>
                @can('create users')
                    <x-primary-button tag="a" href="{{ route('users.create') }}">{{ __('Create User') }}</x-primary-button>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roles</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4">{{ $user->name }}</td>
                                        <td class="px-6 py-4">{{ $user->email }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-1">
                                                @forelse ($user->roles as $role)
                                                    <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">{{ $role->name }}</span>
                                                @empty
                                                    <span class="text-sm text-gray-500">{{ __('No roles') }}</span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-3">
                                                @can('view users')
                                                    <x-primary-button tag="a" href="{{ route('users.show', $user) }}" size="sm">{{ __('View') }}</x-primary-button>
                                                @endcan
                                                @can('edit users')
                                                    <x-primary-button tag="a" href="{{ route('users.edit', $user) }}" size="sm" variant="secondary">{{ __('Edit') }}</x-primary-button>
                                                @endcan
                                                @can('delete users')
                                                    <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('{{ __('Delete this user?') }}');">
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
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">{{ __('No users found.') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
