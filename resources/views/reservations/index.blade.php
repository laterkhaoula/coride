<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-900 dark:text-white leading-tight">
            Gestion des Réservations
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 dark:bg-emerald-950/40 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 dark:bg-rose-950/40 dark:border-rose-800 text-rose-800 dark:text-rose-200 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <!-- Tab Navigation (Alpine.js) -->
            <div x-data="{ tab: 'passager' }" class="space-y-6">
                <div class="flex border-b border-slate-200 dark:border-slate-800 space-x-6">
                    <button @click="tab = 'passager'" :class="tab === 'passager' ? 'border-indigo-600 text-indigo-600 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700'" class="pb-3 text-sm font-semibold border-b-2 transition">
                        Mes réservations (Passager) ({{ $mesReservations->count() }})
                    </button>
                    <button @click="tab = 'conducteur'" :class="tab === 'conducteur' ? 'border-indigo-600 text-indigo-600 font-bold' : 'border-transparent text-slate-500 hover:text-slate-700'" class="pb-3 text-sm font-semibold border-b-2 transition">
                        Demandes reçues (Conducteur) ({{ $demandesRecues->count() }})
                    </button>
                </div>

                <!-- Tab 1: Mes Réservations Passager -->
                <div x-show="tab === 'passager'" class="space-y-4">
                    @forelse($mesReservations as $res)
                        <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div class="space-y-1">
                                <span class="text-xs font-semibold text-slate-400">Trajet #{{ $res->trajet_id }}</span>
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span>{{ $res->trajet->ville_depart ?? 'N/A' }}</span>
                                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    <span>{{ $res->trajet->ville_arrivee ?? 'N/A' }}</span>
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                    Conducteur: <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $res->trajet->conducteur->nom ?? 'N/A' }}</span> | Date: {{ $res->date_reservation }} | Horaire: {{ $res->trajet->horaire ?? 'N/A' }}
                                </p>
                            </div>
                            <div class="flex items-center gap-3">
                                @if($res->statut === 'confirmee')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200">Confirmée</span>
                                @elseif($res->statut === 'en_attente')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300 border border-amber-200">En attente</span>
                                @elseif($res->statut === 'refusee')
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 dark:bg-rose-950 dark:text-rose-300 border border-rose-200">Refusée</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-200 text-slate-700">Annulée</span>
                                @endif

                                @if(in_array($res->statut, ['en_attente', 'confirmee']))
                                    <form method="POST" action="{{ route('reservations.updateStatus', $res) }}" onsubmit="return confirm('Confirmer l\'annulation ?');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="statut" value="annulee">
                                        <button type="submit" class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-medium rounded-xl transition">
                                            Annuler
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800">
                            <p class="text-slate-500 font-medium">Vous n'avez effectué aucune réservation pour l'instant.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Tab 2: Demandes reçues Conducteur -->
                <div x-show="tab === 'conducteur'" class="space-y-4" style="display: none;">
                    @forelse($demandesRecues as $res)
                        <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div class="space-y-1">
                                <span class="text-xs font-semibold text-slate-400">Passager: {{ $res->passager->nom }} ({{ $res->passager->entreprise->nom ?? 'Entreprise' }})</span>
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <span>{{ $res->trajet->ville_depart ?? 'N/A' }}</span>
                                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    <span>{{ $res->trajet->ville_arrivee ?? 'N/A' }}</span>
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                    Date demandée: {{ $res->date_reservation }} | Email: {{ $res->passager->email }}
                                </p>
                            </div>
                            <div class="flex items-center gap-3">
                                @if($res->statut === 'en_attente')
                                    <form method="POST" action="{{ route('reservations.updateStatus', $res) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="statut" value="confirmee">
                                        <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-xl shadow-sm transition">
                                            Confirmer
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('reservations.updateStatus', $res) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="statut" value="refusee">
                                        <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs rounded-xl shadow-sm transition">
                                            Refuser
                                        </button>
                                    </form>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-bold capitalize bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                        {{ $res->statut }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800">
                            <p class="text-slate-500 font-medium">Aucune demande de réservation reçue pour vos trajets.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
