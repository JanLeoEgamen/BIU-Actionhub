<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">{{ __('Edit Role') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-card shadow-sm rounded-xl border">
                <div class="p-6 space-y-6">
                    <form method="POST" action="{{ route('roles.update', $role) }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <x-ui.label for="name" :value="__('Role Name')" required />
                                <x-ui.input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name', $role->name) }}"
                                    required
                                    class="mt-1"
                                />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-sm font-medium text-foreground">Permissions</h3>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach ($permissions as $permission)
                                    <label class="flex items-center gap-3 p-3 border border-border rounded-lg hover:bg-accent/50 transition-colors">
                                        <x-ui.checkbox
                                            name="permissions[]"
                                            :value="$permission->id"
                                            :checked="in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray()))"
                                        />
                                        <span class="text-sm text-muted-foreground">{{ $permission->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <x-ui.button tag="a" href="{{ route('roles.index') }}" variant="outline" class="flex-1">{{ __('Cancel') }}</x-ui.button>
                            <x-ui.button type="submit" class="flex-1">{{ __('Update Role') }}</x-ui.button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>