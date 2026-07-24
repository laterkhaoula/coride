<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 text-[10px] font-black uppercase tracking-wider">Plateforme Entreprise</span>
                    <span class="text-xs text-slate-400">&bull;</span>
                    <span class="text-xs text-slate-500 font-medium">{{ Auth::user()->entreprise->nom ?? 'Entreprise' }}</span>
                </div>
                <h2 class="font-black text-2xl text-slate-900 dark:text-white leading-tight">
                    Tableau de bord CoRide
                </h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('trajets.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-md shadow-indigo-500/20 transition duration-200">
                    <span>🚘</span>
                    <span>Proposer un trajet</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 dark:bg-emerald-950/40 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 rounded-xl bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center">✓</span>
                        <span class="font-medium text-sm">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 dark:bg-rose-950/40 dark:border-rose-800 text-rose-800 dark:text-rose-200 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 rounded-xl bg-rose-100 text-rose-700 font-bold flex items-center justify-center">✕</span>
                        <span class="font-medium text-sm">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Carpooling Hero Banner -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 p-8 text-white shadow-xl border border-slate-800">
                <div class="relative z-10 max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/20 backdrop-blur-md border border-indigo-400/30 text-xs font-semibold text-indigo-300 mb-4">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Brique d'Intelligence Artificielle CoRide
                    </div>
                    <h3 class="text-2xl font-black tracking-tight mb-2">Recherche & Matching de trajets intelligents</h3>
                    <p class="text-indigo-200 text-sm leading-relaxed mb-6">
                        Analyse prédictive multi-critères prenant en compte la proximité de votre ville de résidence (<span class="text-white font-bold">{{ Auth::user()->ville_residence }}</span>), l'alignement horaire et la récurrence des trajets.
                    </p>
                    <a href="{{ route('trajets.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-indigo-50 text-slate-900 font-bold text-sm rounded-xl shadow-md transition">
                        <span>🚘</span>
                        <span>Rechercher mon covoiturage</span>
                    </a>
                </div>
            </div>

            <!-- Carpooling Stats Widgets -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Trajets de covoiturage</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-white mt-1">{{ $stats['trajets_count'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl font-bold">
                        🚗
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Réservations</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-white mt-1">{{ $stats['reservations_count'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl font-bold">
                        🎟️
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Salariés Inscrits</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-white mt-1">{{ $stats['employes_count'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xl font-bold">
                        👥
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Entreprises Partenaires</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-white mt-1">{{ $stats['entreprises_count'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-950/50 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xl font-bold">
                        🏢
                    </div>
                </div>
            </div>

            <!-- Dashboard Details Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Trajets Récents -->
                <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white flex items-center gap-2">
                            <span>🚘</span> Derniers trajets publiés
                        </h3>
                        <a href="{{ route('trajets.index') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400">Tout voir &rarr;</a>
                    </div>
                    <div class="space-y-4">
                        @forelse($trajetsRecents as $trajet)
                            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2 text-sm font-bold text-slate-900 dark:text-white">
                                        <span>{{ $trajet->ville_depart }}</span>
                                        <span class="text-indigo-500">&rarr;</span>
                                        <span>{{ $trajet->ville_arrivee }}</span>
                                    </div>
                                    <div class="text-xs text-slate-500 flex items-center gap-3">
                                        <span>🕒 {{ $trajet->horaire }}</span>
                                        <span>👤 {{ $trajet->conducteur->nom ?? 'Conducteur' }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300">
                                        {{ $trajet->placesRestantes() }} / {{ $trajet->places_disponibles }} places
                                    </span>
                                    <div class="mt-1">
                                        <a href="{{ route('trajets.show', $trajet) }}" class="text-xs font-bold text-indigo-600 hover:underline">Détails</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500 py-4 text-center">Aucun trajet disponible.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Mes Réservations en cours -->
                <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white flex items-center gap-2">
                            <span>🎟️</span> Mes réservations actives
                        </h3>
                        <a href="{{ route('reservations.index') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400">Gérer &rarr;</a>
                    </div>
                    <div class="space-y-4">
                        @forelse($mesReservations as $res)
                            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-bold text-slate-900 dark:text-white">
                                        {{ $res->trajet->ville_depart ?? '' }} &rarr; {{ $res->trajet->ville_arrivee ?? '' }}
                                    </p>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        Conducteur : {{ $res->trajet->conducteur->nom ?? 'N/A' }} | Date: {{ $res->date_reservation }}
                                    </p>
                                </div>
                                <div>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold capitalize bg-slate-200 text-slate-700">
                                        {{ $res->statut }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500 py-4 text-center">Aucune réservation active.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
