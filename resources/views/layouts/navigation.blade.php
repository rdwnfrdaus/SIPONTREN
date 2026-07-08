<nav x-data="{ open: false }" class="bg-gradient-to-r from-[#043324] via-[#022117] to-[#043324] border-b border-amber-500/40 sticky top-0 z-50 shadow-lg shadow-emerald-950/10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-10 w-auto" />
                        <div class="flex flex-col">
                            <span class="font-extrabold text-sm tracking-wide text-white leading-none">SIPONTREN</span>
                            <span class="text-[9px] text-amber-400 font-bold tracking-wider uppercase mt-0.5">Al-Amin</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(Auth::user()->isAdmin() || Auth::user()->isPengurus())
                        <x-nav-link :href="route('santri.index')" :active="request()->routeIs('santri.*')">
                            {{ __('Santri') }}
                        </x-nav-link>
                        <x-nav-link :href="route('kelas.index')" :active="request()->routeIs('kelas.*')">
                            {{ __('Kelas') }}
                        </x-nav-link>
                        <x-nav-link :href="route('kamar.index')" :active="request()->routeIs('kamar.*')">
                            {{ __('Kamar') }}
                        </x-nav-link>
                        <x-nav-link :href="route('pembayaran.index')" :active="request()->routeIs('pembayaran.*')">
                            {{ __('Keuangan') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->isSantri())
                        <x-nav-link :href="route('my.profile')" :active="request()->routeIs('my.profile')">
                            {{ __('Profil Saya') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3.5 py-1.5 border border-amber-500/25 text-sm leading-4 font-semibold rounded-xl text-white bg-emerald-950/40 hover:bg-emerald-950/70 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }} <span class="text-[10px] font-bold text-emerald-950 bg-amber-400 px-2 py-0.5 rounded-full ml-1.5 border border-amber-500/20 shadow-sm">({{ ucfirst(Auth::user()->role) }})</span></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-emerald-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                 {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-emerald-100 hover:text-white hover:bg-emerald-900/40 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#03261a] border-t border-emerald-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->isAdmin() || Auth::user()->isPengurus())
                <x-responsive-nav-link :href="route('santri.index')" :active="request()->routeIs('santri.*')">
                    {{ __('Santri') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('kelas.index')" :active="request()->routeIs('kelas.*')">
                    {{ __('Kelas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('kamar.index')" :active="request()->routeIs('kamar.*')">
                    {{ __('Kamar') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pembayaran.index')" :active="request()->routeIs('pembayaran.*')">
                    {{ __('Keuangan') }}
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->isSantri())
                <x-responsive-nav-link :href="route('my.profile')" :active="request()->routeIs('my.profile')">
                    {{ __('Profil Saya') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-emerald-800">
            <div class="px-4">
                <div class="font-bold text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-emerald-300/80">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

