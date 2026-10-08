<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-foreground leading-tight">{{ $user->name }}</h2>
            </div>
            <div>
                @can('edit users')
                    <x-ui.button tag="a" href="{{ route('users.edit', $user) }}">{{ __('Edit User') }}</x-ui.button>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-card shadow-sm rounded-xl border overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-card-foreground">{{ __('User Information') }}</h3>
                    <dl class="mt-4 space-y-3 text-sm">
                        <div class="flex justify-between">
                            <dt class="font-medium text-muted-foreground">{{ __('Name') }}</dt>
                            <dd class="text-foreground">{{ $user->name }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="font-medium text-muted-foreground">{{ __('Email') }}</dt>
                            <dd class="text-foreground">{{ $user->email }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="font-medium text-muted-foreground">{{ __('Created') }}</dt>
                            <dd class="text-foreground">{{ $user->created_at->format('F d, Y h:i A') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="bg-card shadow-sm rounded-xl border overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-card-foreground">{{ __('Roles') }}</h3>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @forelse ($user->roles as $role)
                            <span class="rounded-full bg-secondary px-3 py-1 text-sm text-secondary-foreground">{{ $role->name }}</span>
                        @empty
                            <span class="text-muted-foreground">{{ __('No roles assigned.') }}</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-card shadow-sm rounded-xl border overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-card-foreground">{{ __('Direct Permissions') }}</h3>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @forelse ($user->permissions as $permission)
                            <span class="rounded-full bg-secondary px-3 py-1 text-sm text-secondary-foreground">{{ $permission->name }}</span>
                        @empty
                            <span class="text-muted-foreground">{{ __('No direct permissions.') }}</span>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>