<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-black text-2xl text-slate-900 dark:text-white leading-tight">
                    Entreprises Partenaires
                </h2>
                <p class="text-sm text-slate-500 mt-1">Liste des entreprises adhérentes au réseau CoRide</p>
            </div>
            <a href="{{ route('entreprises.create') }}" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-md transition">
                + Ajouter une entreprise
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($entreprises as $ent)
                    <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm flex items-center justify-between">
                        <div>
                            <span class="w-10 h-10 rounded-2xl bg-indigo-50 dark:bg-indigo-950 text-indigo-600 dark:text-indigo-300 font-black text-lg flex items-center justify-center mb-3">
                                {{ strtoupper(substr($ent->nom, 0, 1)) }}
                            </span>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $ent->nom }}</h3>
                            <p class="text-xs text-slate-500 mt-1">👥 {{ $ent->employes_count ?? $ent->employes()->count() }} salariés inscrits</p>
                        </div>
                        <div>
                            <form method="POST" action="{{ route('entreprises.destroy', $ent) }}" onsubmit="return confirm('Supprimer cette entreprise ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 p-12 text-center bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800">
                        <p class="text-slate-500 font-medium">Aucune entreprise partenaire enregistrée.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
