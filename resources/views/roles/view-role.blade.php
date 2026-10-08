<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $role->name }}</h2>
            </div>
            <div>
                @can('edit roles')
                    <x-primary-button tag="a" href="{{ route('roles.edit', $role) }}">{{ __('Edit Role') }}</x-primary-button>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div>
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('Role Information') }}</h3>
                        <div class="mt-4 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <dt class="font-medium text-gray-500">{{ __('Name') }}</dt>
                                <dd class="text-gray-900">{{ $role->name }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium text-gray-500">{{ __('Guard') }}</dt>
                                <dd class="text-gray-900">{{ $role->guard_name }}</dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('Permissions') }}</h3>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @forelse ($role->permissions as $permission)
                                <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700">{{ $permission->name }}</span>
                            @empty
                                <span class="text-gray-500">{{ __('No permissions assigned.') }}</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('Users With This Role') }}</h3>
                        <div class="mt-4 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($users as $user)
                                        <tr>
                                            <td class="px-6 py-4">{{ $user->name }}</td>
                                            <td class="px-6 py-4">{{ $user->email }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="px-6 py-6 text-center text-gray-500">{{ __('No users have this role.') }}</td>
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
    </div>
</x-app-layout>
