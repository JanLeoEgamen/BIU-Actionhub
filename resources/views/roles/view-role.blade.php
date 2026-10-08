<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-foreground leading-tight">{{ $role->name }}</h2>
            </div>
            <div>
                @can('edit roles')
                    <x-ui.button tag="a" href="{{ route('roles.edit', $role) }}">{{ __('Edit Role') }}</x-ui.button>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-card shadow-sm rounded-xl border overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-card-foreground">{{ __('Role Information') }}</h3>
                    <div class="mt-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <dt class="font-medium text-muted-foreground">{{ __('Name') }}</dt>
                            <dd class="text-foreground">{{ $role->name }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="font-medium text-muted-foreground">{{ __('Guard') }}</dt>
                            <dd class="text-foreground">{{ $role->guard_name }}</dd>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-card shadow-sm rounded-xl border overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-card-foreground">{{ __('Permissions') }}</h3>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @forelse ($role->permissions as $permission)
                            <span class="rounded-full bg-secondary px-3 py-1 text-sm text-secondary-foreground">{{ $permission->name }}</span>
                        @empty
                            <span class="text-muted-foreground">{{ __('No permissions assigned.') }}</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-card shadow-sm rounded-xl border overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-card-foreground">{{ __('Users With This Role') }}</h3>
                    <div class="mt-4 overflow-x-auto">
                        <x-ui.table>
                            <x-ui.table.header>
                                <x-ui.table.row>
                                    <x-ui.table.head>Name</x-ui.table.head>
                                    <x-ui.table.head>Email</x-ui.table.head>
                                </x-ui.table.row>
                            </x-ui.table.header>
                            <x-ui.table.body>
                                @forelse ($users as $user)
                                    <x-ui.table.row>
                                        <x-ui.table.cell>{{ $user->name }}</x-ui.table.cell>
                                        <x-ui.table.cell>{{ $user->email }}</x-ui.table.cell>
                                    </x-ui.table.row>
                                @empty
                                    <x-ui.table.row>
                                        <x-ui.table.cell colspan="2" class="px-6 py-6 text-center text-muted-foreground">{{ __('No users have this role.') }}</x-ui.table.cell>
                                    </x-ui.table.row>
                                @endforelse
                            </x-ui.table.body>
                        </x-ui.table>
                    </div>
                    <div class="mt-6">{{ $users->links() }}</div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>