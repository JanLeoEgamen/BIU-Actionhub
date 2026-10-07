<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $user->name }}
            </h2>

            @can('edit users')

                <a
                    href="{{ route('users.edit', $user) }}"
                    class="px-4 py-2 bg-gray-800 text-white rounded-md"
                >
                    Edit User
                </a>

            @endcan

        </div>

    </x-slot>

    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold">
                        User Information
                    </h3>

                    <dl class="mt-4 space-y-3">

                        <div>
                            <dt class="font-medium text-gray-500">
                                Name
                            </dt>

                            <dd>
                                {{ $user->name }}
                            </dd>
                        </div>

                        <div>
                            <dt class="font-medium text-gray-500">
                                Email
                            </dt>

                            <dd>
                                {{ $user->email }}
                            </dd>
                        </div>

                        <div>
                            <dt class="font-medium text-gray-500">
                                Created
                            </dt>

                            <dd>
                                {{ $user->created_at->format('F d, Y h:i A') }}
                            </dd>
                        </div>

                    </dl>

                </div>

            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold">
                        Roles
                    </h3>

                    <div class="mt-4 flex flex-wrap gap-2">

                        @forelse ($user->roles as $role)

                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">
                                {{ $role->name }}
                            </span>

                        @empty

                            <span class="text-gray-500">
                                No roles assigned.
                            </span>

                        @endforelse

                    </div>

                </div>

            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold">
                        Direct Permissions
                    </h3>

                    <div class="mt-4 flex flex-wrap gap-2">

                        @forelse ($user->permissions as $permission)

                            <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">
                                {{ $permission->name }}
                            </span>

                        @empty

                            <span class="text-gray-500">
                                No direct permissions.
                            </span>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>