<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Create Role') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl border border-gray-200">
                <div class="p-6 space-y-6">
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="name" :value="__('Role Name')" required />
                                <x-text-input
                                    id="name"
                                    name="name"
                                    type="text"
                                    :value="old('name')"
                                    required
                                    autofocus
                                    class="mt-1"
                                />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-sm font-medium text-gray-900">Permissions</h3>
                            <p class="text-sm text-gray-500 mt-1">Select the permissions this role should have.</p>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                                @forelse ($permissions as $permission)
                                    <label class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                                        <input
                                            type="checkbox"
                                            name="permissions[]"
                                            value="{{ $permission->id }}"
                                            @checked(in_array($permission->id, old('permissions', [])))
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                        />
                                        <span class="text-sm text-gray-700">{{ $permission->name }}</span>
                                    </label>
                                @empty
                                    <p class="text-sm text-gray-500">{{ __('No permissions have been created yet.') }}</p>
                                @endforelse
                            </div>
                            <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <x-secondary-button tag="a" href="{{ route('roles.index') }}" class="flex-1">{{ __('Cancel') }}</x-secondary-button>
                            <x-primary-button class="flex-1">{{ __('Create Role') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
