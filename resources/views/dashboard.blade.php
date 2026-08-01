<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200">Plateforme Entreprise</span>
                    <span class="text-xs text-slate-400">&bull;</span>
                    <span class="text-xs text-slate-500 font-medium">{{ Auth::user()->entreprise->nom ?? 'Entreprise Partenaire' }}</span>
                </div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Tableau de bord CoRide
                </h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('trajets.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-sm transition">
                    <span>+ Proposer un trajet</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-3">
                <span class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center text-xs">✓</span>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-center gap-3">
                <span class="w-6 h-6 rounded-full bg-rose-100 text-rose-700 font-bold flex items-center justify-center text-xs">✕</span>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Autoroute / Road Theme Hero Banner -->
        <div class="relative overflow-hidden rounded-2xl min-h-[220px] shadow-sm border border-slate-200 flex items-center">
            <img src="/images/hero_carpool_highway.png" alt="Autoroute Carpool" class="absolute inset-0 w-full h-full object-cover object-center" />
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-900/75 to-slate-950/40"></div>

            <div class="relative z-10 p-6 sm:p-8 max-w-2xl text-white space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-semibold text-emerald-300">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Réseau Autoroute & Trajets Commute
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-white leading-snug">
                    Trouvez votre trajet autoroute domicile-travail
                </h3>
                <p class="text-slate-200 text-sm leading-relaxed">
                    Module d'IA CoRide actif : calcul de la proximité d'itinéraire et de l'alignement horaire pour votre résidence à <span class="font-bold text-white">{{ Auth::user()->ville_residence }}</span>.
                </p>
                <div class="pt-1">
                    <a href="{{ route('trajets.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-lg shadow-sm transition">
                        <span>🚘</span>
                        <span>Rechercher les trajets sur la route</span> &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm space-y-2">
                <div class="flex items-center justify-between text-slate-500">
                    <span class="text-xs font-semibold uppercase tracking-wider">Trajets Autoroute</span>
                    <span class="p-2 rounded-lg bg-indigo-50 text-indigo-600 font-bold text-sm">🚗</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-900">{{ $stats['trajets_count'] ?? 0 }}</p>
                <p class="text-xs text-slate-400">Offres actives en réseau</p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm space-y-2">
                <div class="flex items-center justify-between text-slate-500">
                    <span class="text-xs font-semibold uppercase tracking-wider">Réservations</span>
                    <span class="p-2 rounded-lg bg-emerald-50 text-emerald-600 font-bold text-sm">🎟️</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-900">{{ $stats['reservations_count'] ?? 0 }}</p>
                <p class="text-xs text-slate-400">Demandes de places</p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm space-y-2">
                <div class="flex items-center justify-between text-slate-500">
                    <span class="text-xs font-semibold uppercase tracking-wider">Salariés Inscrits</span>
                    <span class="p-2 rounded-lg bg-blue-50 text-blue-600 font-bold text-sm">👥</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-900">{{ $stats['employes_count'] ?? 0 }}</p>
                <p class="text-xs text-slate-400">Membres vérifiés</p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm space-y-2">
                <div class="flex items-center justify-between text-slate-500">
                    <span class="text-xs font-semibold uppercase tracking-wider">Entreprises Partenaires</span>
                    <span class="p-2 rounded-lg bg-purple-50 text-purple-600 font-bold text-sm">🏢</span>
                </div>
                <p class="text-3xl font-extrabold text-slate-900">{{ $stats['entreprises_count'] ?? 0 }}</p>
                <p class="text-xs text-slate-400">Réseau d'entreprises</p>
            </div>
        </div>

        <!-- Recent Rides & Active Reservations -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Trajets récents -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm space-y-4">
                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                    <h3 class="font-bold text-base text-slate-900">Derniers trajets publiés</h3>
                    <a href="{{ route('trajets.index') }}" class="text-xs font-semibold text-indigo-600 hover:underline">Voir tout &rarr;</a>
                </div>

                <div class="space-y-3">
                    @forelse($trajetsRecents as $trajet)
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between hover:border-slate-200 transition">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 text-sm font-bold text-slate-900">
                                    <span>{{ $trajet->ville_depart }}</span>
                                    <span class="text-indigo-500 font-normal">&rarr;</span>
                                    <span>{{ $trajet->ville_arrivee }}</span>
                                </div>
                                <div class="text-xs text-slate-500 flex items-center gap-3">
                                    <span>🕒 {{ $trajet->horaire }}</span>
                                    <span>👤 {{ $trajet->conducteur->nom ?? 'Conducteur' }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    {{ $trajet->placesRestantes() }} / {{ $trajet->places_disponibles }} places
                                </span>
                                <div class="mt-1">
                                    <a href="{{ route('trajets.show', $trajet) }}" class="text-xs font-semibold text-indigo-600 hover:underline">Détails</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 py-4 text-center">Aucun trajet disponible.</p>
                    @endforelse
                </div>
            </div>

            <!-- Mes réservations -->
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm space-y-4">
                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                    <h3 class="font-bold text-base text-slate-900">Mes réservations en cours</h3>
                    <a href="{{ route('reservations.index') }}" class="text-xs font-semibold text-indigo-600 hover:underline">Gérer &rarr;</a>
                </div>

                <div class="space-y-3">
                    @forelse($mesReservations as $res)
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-slate-900">
                                    {{ $res->trajet->ville_depart ?? '' }} &rarr; {{ $res->trajet->ville_arrivee ?? '' }}
                                </p>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Conducteur: {{ $res->trajet->conducteur->nom ?? 'N/A' }} | Date: {{ $res->date_reservation }}
                                </p>
                            </div>
                            <div>
                                @if($res->statut === 'confirmee')
                                    <span class="px-2.5 py-0.5 rounded text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Confirmée</span>
                                @elseif($res->statut === 'en_attente')
                                    <span class="px-2.5 py-0.5 rounded text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">En attente</span>
                                @elseif($res->statut === 'refusee')
                                    <span class="px-2.5 py-0.5 rounded text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">Refusée</span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">Annulée</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 py-4 text-center">Aucune réservation active.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
