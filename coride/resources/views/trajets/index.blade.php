<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-0.5 rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-950 dark:text-indigo-300 text-xs font-bold uppercase tracking-wider">Réseau Salariés</span>
                    <span class="text-xs text-slate-400">&bull;</span>
                    <span class="text-xs font-medium text-slate-500">Commute Domicile-Travail</span>
                </div>
                <h2 class="font-black text-2xl text-slate-900 dark:text-white leading-tight mt-1 flex items-center gap-2">
                    <span>Offres de Covoiturage & IA Matching</span>
                </h2>
            </div>
            @if(Auth::user()->isConducteur())
                <a href="{{ route('trajets.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-bold text-sm rounded-xl shadow-md shadow-indigo-500/20 transition duration-200">
                    <span>🚘</span>
                    <span>Proposer un trajet</span>
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 dark:bg-emerald-950/40 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 font-bold flex items-center justify-center">✓</span>
                        <span class="font-medium text-sm">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 dark:bg-rose-950/40 dark:border-rose-800 text-rose-800 dark:text-rose-200 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl bg-rose-100 dark:bg-rose-900 text-rose-700 dark:text-rose-300 font-bold flex items-center justify-center">✕</span>
                        <span class="font-medium text-sm">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Search Bar: Carpooling Route Search -->
            <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm relative overflow-hidden">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider flex items-center gap-2">
                        <span>📍</span> Rechercher un itinéraire de covoiturage
                    </h3>
                    <span class="text-xs text-slate-400">Filtrage instantané par ville et heure</span>
                </div>
                <form method="GET" action="{{ route('trajets.index') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div>
                        <x-input-label for="ville_depart" value="Ville de départ 🏁" />
                        <x-text-input id="ville_depart" class="block mt-1 w-full text-sm" type="text" name="ville_depart" :value="request('ville_depart')" placeholder="Ex: Bouznika, Paris..." />
                    </div>
                    <div>
                        <x-input-label for="ville_arrivee" value="Ville d'arrivée 🎯" />
                        <x-text-input id="ville_arrivee" class="block mt-1 w-full text-sm" type="text" name="ville_arrivee" :value="request('ville_arrivee')" placeholder="Ex: Rabat, Salé..." />
                    </div>
                    <div>
                        <x-input-label for="horaire" value="Horaire 🕒" />
                        <x-text-input id="horaire" class="block mt-1 w-full text-sm" type="text" name="horaire" :value="request('horaire')" placeholder="Ex: 08:00" />
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="w-full py-2.5 bg-slate-900 hover:bg-slate-800 dark:bg-indigo-600 dark:hover:bg-indigo-700 text-white font-bold text-sm rounded-xl shadow-sm transition">
                            Rechercher
                        </button>
                        <a href="{{ route('trajets.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-semibold text-xs rounded-xl transition flex items-center justify-center">
                            🔄
                        </a>
                    </div>
                </form>
            </div>

            <!-- Ride List -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($trajets as $trajet)
                    @php
                        $aiResult = $trajet->resultsIA->first()?->compatibility;
                    @endphp
                    <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex flex-col justify-between hover:shadow-lg transition duration-200 relative group">
                        
                        <div>
                            <!-- Header & Company Tag -->
                            <div class="flex justify-between items-start mb-4">
                                <div class="space-y-1">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-bold border border-slate-200/60 dark:border-slate-700/60">
                                        <span>🏢</span> {{ $trajet->conducteur->entreprise->nom ?? 'Entreprise Partenaire' }}
                                    </span>
                                </div>
                                <div>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                        <span>💺</span> {{ $trajet->placesRestantes() }} / {{ $trajet->places_disponibles }} libres
                                    </span>
                                </div>
                            </div>

                            <!-- Route Visual Component -->
                            <div class="p-4 rounded-2xl bg-gradient-to-r from-slate-50 to-indigo-50/30 dark:from-slate-800/40 dark:to-slate-800/20 border border-slate-100 dark:border-slate-800 mb-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] uppercase font-bold text-slate-400">Départ</span>
                                        <span class="text-lg font-black text-slate-900 dark:text-white">{{ $trajet->ville_depart }}</span>
                                    </div>

                                    <!-- Road Line Connector -->
                                    <div class="flex-1 mx-4 flex flex-col items-center">
                                        <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400">🕒 {{ $trajet->horaire }}</span>
                                        <div class="w-full h-1 bg-slate-200 dark:bg-slate-700 rounded-full relative my-1">
                                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-indigo-600"></div>
                                            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                                        </div>
                                        <span class="text-[10px] text-slate-400 font-medium truncate max-w-[120px]">📅 {{ $trajet->jours_recurrence }}</span>
                                    </div>

                                    <div class="flex flex-col text-right">
                                        <span class="text-[10px] uppercase font-bold text-slate-400">Arrivée</span>
                                        <span class="text-lg font-black text-slate-900 dark:text-white">{{ $trajet->ville_arrivee }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Driver Info Card -->
                            <div class="flex items-center justify-between text-xs text-slate-600 dark:text-slate-300 mb-4 px-1">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-indigo-100 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 font-bold flex items-center justify-center text-xs">
                                        {{ strtoupper(substr($trajet->conducteur->nom, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="font-bold text-slate-900 dark:text-white block">{{ $trajet->conducteur->nom }}</span>
                                        <span class="text-[10px] text-slate-400">Salarié Conducteur</span>
                                    </div>
                                </div>
                                <span class="text-xs font-medium text-slate-500">Résidence : {{ $trajet->conducteur->ville_residence }}</span>
                            </div>

                            <!-- AI Score Badge Card -->
                            @if($aiResult && $trajet->conducteur_id !== Auth::id())
                                <div class="p-4 rounded-2xl border mb-4 {{ $aiResult->getBadgeClass() }} space-y-1.5 transition">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="text-base">⚡</span>
                                            <span class="font-black text-xs uppercase tracking-wider">Matching IA CoRide</span>
                                        </div>
                                        <span class="text-xs font-black px-2.5 py-0.5 rounded-full bg-white/70 dark:bg-black/40 border border-current">
                                            {{ $aiResult->score }}% &bull; {{ $aiResult->getBadgeLabel() }}
                                        </span>
                                    </div>
                                    <p class="text-xs leading-relaxed opacity-95">
                                        {{ $aiResult->justification }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Card Footer Action -->
                        <div class="flex items-center justify-between pt-4 border-t border-slate-100 dark:border-slate-800 mt-2">
                            <a href="{{ route('trajets.show', $trajet) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 transition flex items-center gap-1">
                                Voir la fiche trajet &rarr;
                            </a>

                            @if(Auth::id() !== $trajet->conducteur_id && Auth::user()->isPassager())
                                @if($trajet->placesRestantes() > 0)
                                    <form method="POST" action="{{ route('reservations.store') }}">
                                        @csrf
                                        <input type="hidden" name="trajet_id" value="{{ $trajet->id }}">
                                        <input type="hidden" name="date_reservation" value="{{ date('Y-m-d') }}">
                                        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/20 transition">
                                            Réserver une place
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="px-4 py-2 bg-slate-200 text-slate-400 font-bold text-xs rounded-xl cursor-not-allowed">
                                        Complet
                                    </button>
                                @endif
                            @elseif(Auth::id() === $trajet->conducteur_id)
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('trajets.edit', $trajet) }}" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-semibold rounded-lg">Modifier</a>
                                    <form method="POST" action="{{ route('trajets.destroy', $trajet) }}" onsubmit="return confirm('Supprimer ce trajet ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-rose-50 text-rose-700 dark:bg-rose-950 text-xs font-semibold rounded-lg">Supprimer</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 p-12 text-center bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800">
                        <p class="text-slate-500 font-medium">Aucun trajet disponible correspondant à votre recherche.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
