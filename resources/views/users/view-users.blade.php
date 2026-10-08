<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $user->name }}</h2>
            </div>
            <div>
                @can('edit users')
                    <x-primary-button tag="a" href="{{ route('users.edit', $user) }}">{{ __('Edit User') }}</x-primary-button>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div>
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('User Information') }}</h3>
                        <dl class="mt-4 space-y-3 text-sm">
                            <div class="flex justify-between">
                                <dt class="font-medium text-gray-500">{{ __('Name') }}</dt>
                                <dd class="text-gray-900">{{ $user->name }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium text-gray-500">{{ __('Email') }}</dt>
                                <dd class="text-gray-900">{{ $user->email }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="font-medium text-gray-500">{{ __('Created') }}</dt>
                                <dd class="text-gray-900">{{ $user->created_at->format('F d, Y h:i A') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('Roles') }}</h3>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @forelse ($user->roles as $role)
                                <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700">{{ $role->name }}</span>
                            @empty
                                <span class="text-gray-500">{{ __('No roles assigned.') }}</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('Direct Permissions') }}</h3>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @forelse ($user->permissions as $permission)
                                <span class="px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700">{{ $permission->name }}</span>
                            @empty
                                <span class="text-gray-500">{{ __('No direct permissions.') }}</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
