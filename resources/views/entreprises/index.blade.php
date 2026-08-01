<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Entreprises Partenaires
                </h2>
                <p class="text-xs text-slate-500 mt-1">Liste des 5 entreprises partenaires CoRide</p>
            </div>
            <a href="{{ route('entreprises.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-sm transition">
                + Ajouter une entreprise
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($entreprises as $ent)
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-between hover:border-slate-300 transition">
                    <div class="space-y-1">
                        <span class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-700 font-bold text-sm flex items-center justify-center border border-indigo-100 mb-2">
                            {{ strtoupper(substr($ent->nom, 0, 1)) }}
                        </span>
                        <h3 class="text-base font-bold text-slate-900">{{ $ent->nom }}</h3>
                        <p class="text-xs text-slate-500">👥 {{ $ent->employes_count ?? $ent->employes()->count() }} salariés inscrits</p>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('entreprises.destroy', $ent) }}" onsubmit="return confirm('Supprimer cette entreprise ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Supprimer">
                                🗑️
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-3 p-12 text-center bg-white rounded-2xl border border-slate-200">
                    <p class="text-slate-500 font-medium">Aucune entreprise enregistrée.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
