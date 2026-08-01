<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 text-[10px] font-black uppercase tracking-wider">Covoiturage Écoresponsable</span>
                    <span class="text-xs text-slate-400">&bull;</span>
                    <span class="text-xs text-slate-500 font-medium">{{ Auth::user()->entreprise->nom ?? 'Entreprise Partenaire' }}</span>
                </div>
                <h2 class="font-black text-2xl text-slate-900 dark:text-white leading-tight">
                    Tableau de bord CoRide
                </h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('trajets.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/25 transition duration-200">
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

            <!-- Real-Photo Highway Hero Section -->
            <div class="relative overflow-hidden rounded-3xl min-h-[320px] shadow-2xl border border-slate-200/50 dark:border-slate-800 flex items-center">
                <img src="/images/hero_carpool_highway.png" alt="Highway Carpool" class="absolute inset-0 w-full h-full object-cover object-center" />
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-900/80 to-slate-950/40 backdrop-blur-[2px]"></div>

                <div class="relative z-10 p-8 sm:p-12 max-w-2xl text-white">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-semibold text-emerald-300 mb-4">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Expérience de mobilité & confort
                    </div>
                    <h3 class="text-3xl font-black tracking-tight mb-3 text-white leading-snug">
                        Partagez vos trajets quotidiens en toute sérénité
                    </h3>
                    <p class="text-slate-200 text-sm leading-relaxed mb-6">
                        Grâce à la brique d'IA CoRide, découvrez des offres de covoiturage parfaitement adaptées à votre résidence à <span class="text-emerald-300 font-bold">{{ Auth::user()->ville_residence }}</span> et vos horaires de travail.
                    </p>
                    <a href="{{ route('trajets.index') }}" class="inline-flex items-center gap-2.5 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-indigo-500/30 transition">
                        <span>📍</span>
                        <span>Trouver un trajet sur la route</span>
                    </a>
                </div>
            </div>

            <!-- Stats Widgets -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between hover:border-indigo-200 transition">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Trajets de covoiturage</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-white mt-1">{{ $stats['trajets_count'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl font-bold">
                        🚗
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between hover:border-emerald-200 transition">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Réservations</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-white mt-1">{{ $stats['reservations_count'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl font-bold">
                        🎟️
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between hover:border-blue-200 transition">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Salariés Inscrits</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-white mt-1">{{ $stats['employes_count'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xl font-bold">
                        👥
                    </div>
                </div>

                <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between hover:border-purple-200 transition">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Entreprises Partenaires</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-white mt-1">{{ $stats['entreprises_count'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 dark:bg-purple-950/50 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xl font-bold">
                        🏢
                    </div>
                </div>
            </div>

            <!-- Middle Feature Section with Photographic Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Carpool Comfort Card with Real Photo -->
                <div class="relative overflow-hidden rounded-3xl min-h-[260px] shadow-lg border border-slate-200 dark:border-slate-800 flex flex-col justify-end p-6 group">
                    <img src="/images/carpool_passengers_comfort.png" alt="Passenger Comfort" class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/60 to-transparent"></div>
                    <div class="relative z-10 text-white space-y-2">
                        <span class="px-2.5 py-1 rounded-full bg-emerald-500/80 text-white text-[10px] font-bold uppercase tracking-wider">Confort & Convivialité</span>
                        <h4 class="text-xl font-bold leading-snug">Partagez votre trajet entre collègues</h4>
                        <p class="text-xs text-slate-200">Rejoignez un réseau de salariés vérifiés de votre entreprise.</p>
                    </div>
                </div>

                <!-- Scenic Highway Card with Real Photo -->
                <div class="relative overflow-hidden rounded-3xl min-h-[260px] shadow-lg border border-slate-200 dark:border-slate-800 flex flex-col justify-end p-6 group">
                    <img src="/images/scenic_road_commute.png" alt="Scenic Road Commute" class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" />
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/60 to-transparent"></div>
                    <div class="relative z-10 text-white space-y-2">
                        <span class="px-2.5 py-1 rounded-full bg-indigo-500/80 text-white text-[10px] font-bold uppercase tracking-wider">Itinéraires Fluides</span>
                        <h4 class="text-xl font-bold leading-snug">Économie & Empreinte Carbone Réduite</h4>
                        <p class="text-xs text-slate-200">Optimisation des autoroutes et voies d'accès professionnelles.</p>
                    </div>
                </div>

                <!-- AI Score Info Box -->
                <div class="p-6 rounded-3xl bg-gradient-to-br from-indigo-900 to-slate-900 text-white shadow-lg border border-indigo-800 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-2xl bg-indigo-500/30 border border-indigo-400/30 text-emerald-400 font-black text-xl flex items-center justify-center mb-4">
                            ⚡
                        </div>
                        <h4 class="text-lg font-bold mb-2">Algorithme d'IA CoRide</h4>
                        <p class="text-xs text-indigo-200 leading-relaxed mb-4">
                            Notre algorithme analyse la compatibilité réelle entre la ville de départ, de destination et les horaires de travail de chaque salarié.
                        </p>
                    </div>
                    <a href="{{ route('trajets.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-emerald-300 hover:underline">
                        <span>Explorer les scores d'IA</span> &rarr;
                    </a>
                </div>
            </div>

            <!-- Recent Rides & Active Reservations Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Trajets Récents -->
                <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white flex items-center gap-2">
                            <span>🚘</span> Trajets de covoiturage récents
                        </h3>
                        <a href="{{ route('trajets.index') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Tout voir &rarr;</a>
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
                            <p class="text-sm text-slate-500 py-4 text-center">Aucun trajet disponible pour le moment.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Mes Réservations en cours -->
                <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white flex items-center gap-2">
                            <span>🎟️</span> Mes réservations actives
                        </h3>
                        <a href="{{ route('reservations.index') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Gérer &rarr;</a>
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
