<x-app-layout>
 <x-slot name="header">
 <div class="flex items-center justify-between">
 <h2 class="font-bold text-2xl text-slate-900 leading-tight">
 Détails du Trajet #{{ $trajet->id }}
 </h2>
 <a href="{{ route('trajets.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">&larr; Retour aux trajets</a>
 </div>
 </x-slot>

 <div class="py-8 bg-slate-50 min-h-screen">
 <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
 
 @if(session('success'))
 <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-3">
 <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
 <span>{{ session('success') }}</span>
 </div>
 @endif

 @if(session('error'))
 <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm flex items-center gap-3">
 <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
 <span>{{ session('error') }}</span>
 </div>
 @endif

 <!-- Main Info Card -->
 <div class="p-8 rounded-xl bg-white border border-slate-200/80 shadow-sm space-y-6">
 
 <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 pb-6 border-b border-slate-100">
 <div>
 <span class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-bold uppercase tracking-wider mb-2">
 {{ $trajet->conducteur->entreprise->nom ?? 'Entreprise' }}
 </span>
 <h3 class="text-3xl font-bold text-slate-900 flex items-center gap-3">
 <span>{{ $trajet->ville_depart }}</span>
 <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
 <span>{{ $trajet->ville_arrivee }}</span>
 </h3>
 </div>
 <div>
 <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
 {{ $trajet->placesRestantes() }} / {{ $trajet->places_disponibles }} places disponibles
 </span>
 </div>
 </div>

 <!-- Attributes Grid -->
 <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
 <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
 <span class="text-xs font-semibold text-slate-400 block uppercase">Conducteur</span>
 <p class="text-base font-bold text-slate-900 mt-1">{{ $trajet->conducteur->nom }}</p>
 <p class="text-xs text-slate-500">{{ $trajet->conducteur->email }}</p>
 </div>
 <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
 <span class="text-xs font-semibold text-slate-400 block uppercase">Horaire de départ</span>
 <p class="text-base font-bold text-slate-900 mt-1">{{ $trajet->horaire }}</p>
 </div>
 <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
 <span class="text-xs font-semibold text-slate-400 block uppercase">Récurrence</span>
 <p class="text-base font-bold text-slate-900 mt-1">{{ $trajet->jours_recurrence }}</p>
 </div>
 </div>

 <!-- AI Analysis Card -->
 @if($aiResult)
 <div class="p-6 rounded-xl border {{ $aiResult->getBadgeClass() }} space-y-3">
 <div class="flex items-center justify-between">
 <div class="flex items-center gap-3">
 <div class="w-10 h-10 rounded-lg bg-white/60 flex items-center justify-center font-bold text-lg">
 {{ $aiResult->score }}%
 </div>
 <div>
 <h4 class="font-bold text-base">Analyse de Compatibilité Laravel AI</h4>
 <p class="text-xs opacity-80">{{ $aiResult->getBadgeLabel() }}</p>
 </div>
 </div>
 </div>
 <div class="pt-3 border-t border-black/10 text-sm leading-relaxed">
 {{ $aiResult->justification }}
 </div>
 </div>
 @endif

 <!-- Reservation Form / Driver Actions -->
 <div class="pt-6 border-t border-slate-100 flex justify-between items-center">
 @if(Auth::id() !== $trajet->conducteur_id && Auth::user()->isPassager())
 @if($trajet->placesRestantes() > 0)
 <form method="POST" action="{{ route('reservations.store') }}" class="w-full sm:w-auto">
 @csrf
 <input type="hidden" name="trajet_id" value="{{ $trajet->id }}">
 <input type="hidden" name="date_reservation" value="{{ date('Y-m-d') }}">
 <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-lg shadow-md transition">
 Effectuer une réservation
 </button>
 </form>
 @else
 <button disabled class="w-full sm:w-auto px-6 py-3 bg-slate-200 text-slate-500 font-bold text-sm rounded-lg cursor-not-allowed">
 Trajet complet
 </button>
 @endif
 @elseif(Auth::id() === $trajet->conducteur_id)
 <div class="flex items-center gap-3">
 <a href="{{ route('trajets.edit', $trajet) }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg transition">
 Modifier
 </a>
 <form method="POST" action="{{ route('trajets.destroy', $trajet) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?');">
 @csrf
 @method('DELETE')
 <button type="submit" class="px-4 py-2 bg-red-100 hover:bg-red-200 text-red-800 text-sm font-semibold rounded-lg transition">
 Supprimer
 </button>
 </form>
 </div>
 @endif
 </div>

 </div>

 <!-- Existing Reservations Section (For Driver) -->
 @if(Auth::id() === $trajet->conducteur_id)
 <div class="p-8 rounded-xl bg-white border border-slate-200/80 shadow-sm space-y-4">
 <h3 class="font-bold text-lg text-slate-900">Réservations sur ce trajet ({{ $trajet->reservations->count() }})</h3>
 <div class="divide-y divide-slate-100">
 @forelse($trajet->reservations as $res)
 <div class="py-3 flex items-center justify-between">
 <div>
 <p class="text-sm font-bold text-slate-900">{{ $res->passager->nom }} ({{ $res->passager->email }})</p>
 <p class="text-xs text-slate-400">Date: {{ $res->date_reservation }} - Statut: <span class="capitalize font-semibold">{{ $res->statut }}</span></p>
 </div>
 <div class="flex items-center gap-2">
 @if($res->statut === 'en_attente')
 <form method="POST" action="{{ route('reservations.updateStatus', $res) }}">
 @csrf
 @method('PATCH')
 <input type="hidden" name="statut" value="confirmee">
 <button type="submit" class="px-3 py-1 bg-emerald-600 text-white text-xs font-semibold rounded-lg">Confirmer</button>
 </form>
 <form method="POST" action="{{ route('reservations.updateStatus', $res) }}">
 @csrf
 @method('PATCH')
 <input type="hidden" name="statut" value="refusee">
 <button type="submit" class="px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-lg">Refuser</button>
 </form>
 @endif
 </div>
 </div>
 @empty
 <p class="text-xs text-slate-500 py-2">Aucune réservation pour l'instant.</p>
 @endforelse
 </div>
 </div>
 @endif

 </div>
 </div>
</x-app-layout>
