<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                Gestion des Réservations
            </h2>
            <span class="text-xs text-slate-500 font-medium">Suivi des demandes passager & conducteur</span>
        </div>
    </x-slot>

    <div class="space-y-6">
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

        <!-- Tab Navigation (Alpine.js) -->
        <div x-data="{ tab: 'passager' }" class="space-y-6">
            <div class="flex border-b border-slate-200 space-x-4">
                <button @click="tab = 'passager'" :class="tab === 'passager' ? 'border-indigo-600 text-indigo-700 font-bold bg-white border-t border-x rounded-t-lg px-4 py-2.5 -mb-px' : 'border-transparent text-slate-600 hover:text-slate-900 px-4 py-2.5'" class="text-sm font-semibold transition">
                    Mes réservations (Passager) ({{ $mesReservations->count() }})
                </button>
                <button @click="tab = 'conducteur'" :class="tab === 'conducteur' ? 'border-indigo-600 text-indigo-700 font-bold bg-white border-t border-x rounded-t-lg px-4 py-2.5 -mb-px' : 'border-transparent text-slate-600 hover:text-slate-900 px-4 py-2.5'" class="text-sm font-semibold transition">
                    Demandes reçues (Conducteur) ({{ $demandesRecues->count() }})
                </button>
            </div>

            <!-- Tab 1: Mes Réservations Passager -->
            <div x-show="tab === 'passager'" class="space-y-4">
                @forelse($mesReservations as $res)
                    <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="space-y-1">
                            <span class="text-xs text-slate-400 font-medium">Trajet #{{ $res->trajet_id }}</span>
                            <h4 class="text-base font-bold text-slate-900 flex items-center gap-2">
                                <span>{{ $res->trajet->ville_depart ?? 'N/A' }}</span>
                                <span class="text-indigo-500 font-normal">&rarr;</span>
                                <span>{{ $res->trajet->ville_arrivee ?? 'N/A' }}</span>
                            </h4>
                            <p class="text-xs text-slate-500">
                                Conducteur : <strong class="text-slate-800">{{ $res->trajet->conducteur->nom ?? 'N/A' }}</strong> | Date : {{ $res->date_reservation }} | Horaire : {{ $res->trajet->horaire ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="flex items-center gap-3">
                            @if($res->statut === 'confirmee')
                                <span class="px-3 py-1 rounded text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Confirmée</span>
                            @elseif($res->statut === 'en_attente')
                                <span class="px-3 py-1 rounded text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">En attente</span>
                            @elseif($res->statut === 'refusee')
                                <span class="px-3 py-1 rounded text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">Refusée</span>
                            @else
                                <span class="px-3 py-1 rounded text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">Annulée</span>
                            @endif

                            @if(in_array($res->statut, ['en_attente', 'confirmee']))
                                <form method="POST" action="{{ route('reservations.updateStatus', $res) }}" onsubmit="return confirm('Confirmer l\'annulation ?');">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="annulee">
                                    <button type="submit" class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-semibold rounded-lg transition">
                                        Annuler
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center bg-white rounded-2xl border border-slate-200">
                        <p class="text-slate-500 font-medium">Vous n'avez aucune réservation en cours.</p>
                    </div>
                @endforelse
            </div>

            <!-- Tab 2: Demandes reçues Conducteur -->
            <div x-show="tab === 'conducteur'" class="space-y-4" style="display: none;">
                @forelse($demandesRecues as $res)
                    <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="space-y-1">
                            <span class="text-xs text-slate-400 font-medium">Passager: {{ $res->passager->nom }} ({{ $res->passager->entreprise->nom ?? 'Entreprise' }})</span>
                            <h4 class="text-base font-bold text-slate-900 flex items-center gap-2">
                                <span>{{ $res->trajet->ville_depart ?? 'N/A' }}</span>
                                <span class="text-indigo-500 font-normal">&rarr;</span>
                                <span>{{ $res->trajet->ville_arrivee ?? 'N/A' }}</span>
                            </h4>
                            <p class="text-xs text-slate-500">
                                Date demandée: {{ $res->date_reservation }} | Email: {{ $res->passager->email }}
                            </p>
                        </div>
                        <div class="flex items-center gap-3">
                            @if($res->statut === 'en_attente')
                                <form method="POST" action="{{ route('reservations.updateStatus', $res) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="confirmee">
                                    <button type="submit" class="px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-lg shadow-sm transition">
                                        Confirmer
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('reservations.updateStatus', $res) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="refusee">
                                    <button type="submit" class="px-3.5 py-1.5 bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs rounded-lg shadow-sm transition">
                                        Refuser
                                    </button>
                                </form>
                            @else
                                <span class="px-3 py-1 rounded text-xs font-semibold capitalize bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ $res->statut }}
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center bg-white rounded-2xl border border-slate-200">
                        <p class="text-slate-500 font-medium">Aucune demande de réservation reçue.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>
