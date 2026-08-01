<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2.5">
                        <div class="w-9 h-9 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-black text-lg shadow-sm">
                            C
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900">Co<span class="text-indigo-600">Ride</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        Tableau de bord
                    </a>
                    <a href="{{ route('trajets.index') }}" class="inline-flex items-center px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('trajets.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        Trajets & IA
                    </a>
                    <a href="{{ route('reservations.index') }}" class="inline-flex items-center px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('reservations.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        Réservations
                    </a>
                    <a href="{{ route('employes.index') }}" class="inline-flex items-center px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('employes.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        Salariés
                    </a>
                    <a href="{{ route('entreprises.index') }}" class="inline-flex items-center px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('entreprises.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        Entreprises
                    </a>
                </div>
            </div>

            <!-- Profile & Actions -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-3">
                <a href="{{ route('trajets.create') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-lg shadow-sm transition">
                    <span>+</span>
                    <span>Proposer un trajet</span>
                </a>

                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-1.5 border border-slate-200 text-xs font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 focus:outline-none transition">
                            <div class="flex items-center space-x-2 text-left">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <div>
                                    <span class="font-bold text-slate-900 block">{{ Auth::user()->nom ?? Auth::user()->name }}</span>
                                    <span class="text-[10px] text-slate-400 block">{{ Auth::user()->entreprise->nom ?? 'Entreprise' }}</span>
                                </div>
                            </div>
                            <svg class="ms-2 h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-slate-100 text-xs text-slate-500">
                            Rôle : <span class="font-bold text-indigo-600 capitalize">{{ Auth::user()->role ?? 'Membre' }}</span>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">
                            Mon Profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                Déconnexion
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger menu for mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-slate-200 px-4 pt-2 pb-3 space-y-1">
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-sm font-semibold text-slate-700 hover:bg-slate-50">Tableau de bord</a>
        <a href="{{ route('trajets.index') }}" class="block px-3 py-2 rounded-md text-sm font-semibold text-slate-700 hover:bg-slate-50">Trajets & IA</a>
        <a href="{{ route('reservations.index') }}" class="block px-3 py-2 rounded-md text-sm font-semibold text-slate-700 hover:bg-slate-50">Réservations</a>
        <a href="{{ route('employes.index') }}" class="block px-3 py-2 rounded-md text-sm font-semibold text-slate-700 hover:bg-slate-50">Salariés</a>
        <a href="{{ route('entreprises.index') }}" class="block px-3 py-2 rounded-md text-sm font-semibold text-slate-700 hover:bg-slate-50">Entreprises</a>
        <div class="pt-3 border-t border-slate-100 mt-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-sm font-semibold text-rose-600 hover:bg-rose-50">Déconnexion</button>
            </form>
        </div>
    </div>
</nav>
