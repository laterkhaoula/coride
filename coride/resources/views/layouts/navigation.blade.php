<nav x-data="{ open: false }" class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-200/80 dark:border-slate-800 shadow-sm sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-6">
                <!-- Logo with Carpooling Emblem -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-cyan-500 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-indigo-500/25 group-hover:scale-105 transition-transform duration-200">
                            🚗
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-black tracking-tight text-slate-900 dark:text-white leading-none">Co<span class="text-indigo-600 dark:text-indigo-400">Ride</span></span>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Covoiturage Salariés</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition">
                        <span>📊</span> Tableau de bord
                    </x-nav-link>
                    <x-nav-link :href="route('trajets.index')" :active="request()->routeIs('trajets.*')" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition">
                        <span>🚘</span> Trajets & IA
                    </x-nav-link>
                    <x-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.*')" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition">
                        <span>🎟️</span> Réservations
                    </x-nav-link>
                    <x-nav-link :href="route('employes.index')" :active="request()->routeIs('employes.*')" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition">
                        <span>👥</span> Salariés
                    </x-nav-link>
                    <x-nav-link :href="route('entreprises.index')" :active="request()->routeIs('entreprises.*')" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-semibold transition">
                        <span>🏢</span> Entreprises
                    </x-nav-link>
                </div>
            </div>

            <!-- Profile & Quick Action -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-3">
                <a href="{{ route('trajets.create') }}" class="inline-flex items-center gap-2 px-3.5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-xl shadow-md shadow-indigo-500/20 transition">
                    <span>+</span> Proposer un trajet
                </a>

                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-slate-200 dark:border-slate-700 text-xs leading-4 font-medium rounded-xl text-slate-700 dark:text-slate-200 bg-slate-50 dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 focus:outline-none transition">
                            <div class="flex items-center space-x-2 text-left">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-900 dark:text-white">{{ Auth::user()->nom ?? Auth::user()->name }}</span>
                                    <span class="text-[10px] text-slate-400">{{ Auth::user()->entreprise->nom ?? 'Entreprise' }}</span>
                                </div>
                            </div>
                            <svg class="ms-2 h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-800 text-xs text-slate-500">
                            Rôle : <span class="font-bold text-indigo-600 dark:text-indigo-400 capitalize">{{ Auth::user()->role ?? 'Membre' }}</span>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">
                            ⚙️ Mon Profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                🚪 Déconnexion
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger menu for mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-slate-900 border-b border-slate-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                📊 Tableau de bord
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('trajets.index')" :active="request()->routeIs('trajets.*')">
                🚘 Trajets & IA
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.*')">
                🎟️ Réservations
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('employes.index')" :active="request()->routeIs('employes.*')">
                👥 Salariés
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('entreprises.index')" :active="request()->routeIs('entreprises.*')">
                🏢 Entreprises
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-3 border-t border-slate-200 px-4 space-y-2">
            <div class="font-bold text-sm text-slate-800 dark:text-slate-200">{{ Auth::user()->nom ?? Auth::user()->name }}</div>
            <div class="text-xs text-slate-500">{{ Auth::user()->email }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                    Déconnexion
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
