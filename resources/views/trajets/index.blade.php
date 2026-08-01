<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded bg-indigo-50 text-indigo-700 text-xs font-semibold border border-indigo-200">Recherche & IA</span>
                    <span class="text-xs text-slate-400">&bull;</span>
                    <span class="text-xs text-slate-500 font-medium">Commute Domicile-Travail</span>
                </div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Offres de Covoiturage & Score d'IA
                </h2>
            </div>
            @if(Auth::user()->isConducteur())
                <a href="{{ route('trajets.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-sm transition">
                    <span>+ Proposer un trajet</span>
                </a>
            @endif
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

        <!-- Filter Card -->
        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider">Filtrer les trajets par ville & horaire</h3>
                <span class="text-xs text-slate-400">Recherche instantanée</span>
            </div>
            <form method="GET" action="{{ route('trajets.index') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div>
                    <x-input-label for="ville_depart" value="Ville de départ" />
                    <x-text-input id="ville_depart" class="block mt-1 w-full text-sm" type="text" name="ville_depart" :value="request('ville_depart')" placeholder="Ex: Paris, Bouznika..." />
                </div>
                <div>
                    <x-input-label for="ville_arrivee" value="Ville d'arrivée" />
                    <x-text-input id="ville_arrivee" class="block mt-1 w-full text-sm" type="text" name="ville_arrivee" :value="request('ville_arrivee')" placeholder="Ex: Rabat, Salé..." />
                </div>
                <div>
                    <x-input-label for="horaire" value="Horaire" />
                    <x-text-input id="horaire" class="block mt-1 w-full text-sm" type="text" name="horaire" :value="request('horaire')" placeholder="Ex: 08:00" />
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-sm transition">
                        Rechercher
                    </button>
                    <a href="{{ route('trajets.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-xs rounded-lg transition flex items-center justify-center">
                        Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        <!-- Trajets Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($trajets as $trajet)
                @php
                    $aiResult = $trajet->resultsIA->first()?->compatibility;
                @endphp
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm hover:border-slate-300 transition flex flex-col justify-between space-y-4">
                    <div class="space-y-4">
                        <!-- Top Row: Enterprise & Seats -->
                        <div class="flex justify-between items-start">
                            <span class="px-2.5 py-0.5 rounded text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                🏢 {{ $trajet->conducteur->entreprise->nom ?? 'Entreprise Partenaire' }}
                            </span>
                            <span class="px-2.5 py-0.5 rounded text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                {{ $trajet->placesRestantes() }} / {{ $trajet->places_disponibles }} places libres
                            </span>
                        </div>

                        <!-- Departure -> Arrival -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Départ</span>
                                    <span class="text-base font-bold text-slate-900">{{ $trajet->ville_depart }}</span>
                                </div>
                                <div class="text-center px-4">
                                    <span class="text-xs font-bold text-indigo-600 block">🕒 {{ $trajet->horaire }}</span>
                                    <span class="text-slate-300 font-normal">&rarr;</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[10px] font-bold uppercase text-slate-400 block">Arrivée</span>
                                    <span class="text-base font-bold text-slate-900">{{ $trajet->ville_arrivee }}</span>
                                </div>
                            </div>
                            <div class="text-xs text-slate-500 pt-1 border-t border-slate-100 flex items-center justify-between">
                                <span>📅 {{ $trajet->jours_recurrence }}</span>
                                <span>👤 Conducteur : <strong class="text-slate-800">{{ $trajet->conducteur->nom }}</strong></span>
                            </div>
                        </div>

                        <!-- AI Compatibility Box (Soft Indigo Styling) -->
                        @if($aiResult && $trajet->conducteur_id !== Auth::id())
                            <div class="p-4 rounded-xl border {{ $aiResult->getBadgeClass() }} space-y-1.5">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-xs uppercase tracking-wider flex items-center gap-1.5">
                                        <span>⚡</span> Matching IA CoRide
                                    </span>
                                    <span class="text-xs font-bold px-2 py-0.5 rounded bg-white/80 border border-current">
                                        Score : {{ $aiResult->score }}% &bull; {{ $aiResult->getBadgeLabel() }}
                                    </span>
                                </div>
                                <p class="text-xs leading-relaxed opacity-90">
                                    {{ $aiResult->justification }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <!-- Actions Row -->
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('trajets.show', $trajet) }}" class="text-xs font-bold text-indigo-600 hover:underline">
                            Voir la fiche trajet &rarr;
                        </a>

                        @if(Auth::id() !== $trajet->conducteur_id && Auth::user()->isPassager())
                            @if($trajet->placesRestantes() > 0)
                                <form method="POST" action="{{ route('reservations.store') }}">
                                    @csrf
                                    <input type="hidden" name="trajet_id" value="{{ $trajet->id }}">
                                    <input type="hidden" name="date_reservation" value="{{ date('Y-m-d') }}">
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-lg shadow-sm transition">
                                        Réserver une place
                                    </button>
                                </form>
                            @else
                                <button disabled class="px-4 py-2 bg-slate-100 text-slate-400 font-semibold text-xs rounded-lg cursor-not-allowed border border-slate-200">
                                    Complet
                                </button>
                            @endif
                        @elseif(Auth::id() === $trajet->conducteur_id)
                            <div class="flex items-center gap-2">
                                <a href="{{ route('trajets.edit', $trajet) }}" class="px-3 py-1.5 bg-slate-100 text-slate-700 text-xs font-semibold rounded-lg hover:bg-slate-200">Modifier</a>
                                <form method="POST" action="{{ route('trajets.destroy', $trajet) }}" onsubmit="return confirm('Supprimer ce trajet ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-rose-50 text-rose-700 text-xs font-semibold rounded-lg hover:bg-rose-100">Supprimer</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-2 p-12 text-center bg-white rounded-2xl border border-slate-200">
                    <p class="text-slate-500 font-medium">Aucun trajet disponible ne correspond à votre recherche.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
