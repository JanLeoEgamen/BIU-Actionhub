<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-foreground leading-tight">{{ __('Roles') }}</h2>
            </div>
            <div>
                @can('create roles')
                    <x-ui.button tag="a" href="{{ route('roles.create') }}">{{ __('Create Role') }}</x-ui.button>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <x-ui.alert class="mb-4 border-success/50 bg-success/10">
                    <x-ui.icon name="check" />
                    <div>
                        <x-ui.alert.title>{{ session('success') }}</x-ui.alert.title>
                    </div>
                </x-ui.alert>
            @endif

            @if (session('error'))
                <x-ui.alert variant="destructive" class="mb-4">
                    <x-ui.icon name="x" />
                    <div>
                        <x-ui.alert.title>{{ session('error') }}</x-ui.alert.title>
                    </div>
                </x-ui.alert>
            @endif

            <div class="bg-card shadow-sm rounded-xl border overflow-hidden">
                <div class="p-6">
                    <x-ui.table>
                        <x-ui.table.header>
                            <x-ui.table.row>
                                <x-ui.table.head>#</x-ui.table.head>
                                <x-ui.table.head>Role</x-ui.table.head>
                                <x-ui.table.head>Permissions</x-ui.table.head>
                                <x-ui.table.head>Users</x-ui.table.head>
                                <x-ui.table.head class="text-right">Actions</x-ui.table.head>
                            </x-ui.table.row>
                        </x-ui.table.header>
                        <x-ui.table.body>
                            @forelse ($roles as $role)
                                <x-ui.table.row>
                                    <x-ui.table.cell class="whitespace-nowrap">{{ $role->id }}</x-ui.table.cell>
                                    <x-ui.table.cell class="whitespace-nowrap">
                                        <div class="font-medium text-foreground">{{ $role->name }}</div>
                                    </x-ui.table.cell>
                                    <x-ui.table.cell>
                                        <div class="flex flex-wrap gap-1">
                                            @forelse ($role->permissions as $permission)
                                                <span class="rounded bg-secondary px-2 py-1 text-xs text-secondary-foreground">{{ $permission->name }}</span>
                                            @empty
                                                <span class="text-sm text-muted-foreground">{{ __('No permissions') }}</span>
                                            @endforelse
                                        </div>
                                    </x-ui.table.cell>
                                    <x-ui.table.cell class="whitespace-nowrap">{{ $role->users_count }}</x-ui.table.cell>
                                    <x-ui.table.cell class="whitespace-nowrap text-right">
                                        <div class="flex justify-end gap-2">
                                            @can('view roles')
                                                <x-ui.button tag="a" href="{{ route('roles.show', $role) }}" size="sm">{{ __('View') }}</x-ui.button>
                                            @endcan
                                            @can('edit roles')
                                                <x-ui.button tag="a" href="{{ route('roles.edit', $role) }}" size="sm" variant="outline">{{ __('Edit') }}</x-ui.button>
                                            @endcan
                                            @can('delete roles')
                                                <x-ui.button size="sm" variant="destructive" x-on:click="$dispatch('open-dialog', 'confirm-delete-role-{{ $role->id }}')">{{ __('Delete') }}</x-ui.button>
                                            @endcan
                                        </div>
                                    </x-ui.table.cell>
                                </x-ui.table.row>
                            @empty
                                <x-ui.table.row>
                                    <x-ui.table.cell colspan="5" class="px-6 py-8 text-center text-muted-foreground">{{ __('No roles found.') }}</x-ui.table.cell>
                                </x-ui.table.row>
                            @endforelse
                        </x-ui.table.body>
                    </x-ui.table>

                    <div class="mt-6">{{ $roles->links() }}</div>
                </div>
            </div>

            @can('delete roles')
                @foreach ($roles as $role)
                    <x-ui.alert-dialog name="confirm-delete-role-{{ $role->id }}">
                        <x-ui.alert-dialog.header>
                            <x-ui.alert-dialog.title>{{ __('Delete role?') }}</x-ui.alert-dialog.title>
                            <x-ui.alert-dialog.description>
                                {{ __('Are you sure you want to delete this role? This action cannot be undone.') }}
                            </x-ui.alert-dialog.description>
                        </x-ui.alert-dialog.header>
                        <x-ui.alert-dialog.footer>
                            <x-ui.alert-dialog.cancel>{{ __('Cancel') }}</x-ui.alert-dialog.cancel>
                            <form method="POST" action="{{ route('roles.destroy', $role) }}">
                                @csrf
                                @method('DELETE')
                                <x-ui.alert-dialog.action type="submit">{{ __('Delete') }}</x-ui.alert-dialog.action>
                            </form>
                        </x-ui.alert-dialog.footer>
                    </x-ui.alert-dialog>
                @endforeach
            @endcan
        </div>
    </div>
</x-app-layout>