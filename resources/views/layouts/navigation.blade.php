<nav x-data="{ open: false }" class="bg-white border-b border-border">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-foreground" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link
                        :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')"
                    >
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @can('view users')

                        <x-nav-link
                            :href="route('users.index')"
                            :active="request()->routeIs('users.*')"
                        >
                            {{ __('Users') }}
                        </x-nav-link>

                    @endcan

                    @can('view roles')

                        <x-nav-link
                            :href="route('roles.index')"
                            :active="request()->routeIs('roles.*')"
                        >
                            {{ __('Roles') }}
                        </x-nav-link>

                    @endcan

                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-ui.dropdown-menu align="right" width="48">
                    <x-slot:trigger>
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-muted-foreground bg-transparent hover:text-foreground focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <x-ui.icon name="chevron-down" />
                            </div>
                        </button>
                    </x-slot:trigger>

                    <x-ui.dropdown-menu.label>{{ Auth::user()->name }}</x-ui.dropdown-menu.label>
                    <x-ui.dropdown-menu.separator />

                    <x-ui.dropdown-menu.item x-on:click="window.location = '{{ route('profile.edit') }}'">
                        {{ __('Profile') }}
                    </x-ui.dropdown-menu.item>

                    <form id="nav-logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                    </form>

                    <x-ui.dropdown-menu.item x-on:click="document.getElementById('nav-logout-form').submit()">
                        {{ __('Log Out') }}
                    </x-ui.dropdown-menu.item>
                </x-ui.dropdown-menu>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <x-ui.button variant="ghost" size="icon" @click="open = ! open" aria-label="Toggle navigation menu">
                    <x-ui.icon name="menu" />
                </x-ui.button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')"
            >
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @can('view users')

                <x-responsive-nav-link
                    :href="route('users.index')"
                    :active="request()->routeIs('users.*')"
                >
                    {{ __('Users') }}
                </x-responsive-nav-link>

            @endcan

            @can('view roles')

                <x-responsive-nav-link
                    :href="route('roles.index')"
                    :active="request()->routeIs('roles.*')"
                >
                    {{ __('Roles') }}
                </x-responsive-nav-link>

            @endcan

        </div>

        <!-- Responsive Settings Options -->

        <div class="pt-4 pb-1 border-t border-border">

            <div class="px-4">

                <div class="font-medium text-base text-foreground">
                    {{ Auth::user()->name }}
                </div>

                <div class="font-medium text-sm text-muted-foreground">
                    {{ Auth::user()->email }}
                </div>

            </div>

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>
</nav>