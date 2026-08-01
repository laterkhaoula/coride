<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Gestion des Salariés
                </h2>
                <p class="text-xs text-slate-500 mt-1">Annuaire des employés inscrits sur CoRide</p>
            </div>
            <a href="{{ route('employes.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-sm transition">
                + Ajouter un salarié
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="text-xs uppercase bg-slate-50 text-slate-500 font-bold border-b border-slate-200">
                        <tr>
                            <th class="p-3.5">Nom</th>
                            <th class="p-3.5">Email professionnel</th>
                            <th class="p-3.5">Entreprise partenaire</th>
                            <th class="p-3.5">Ville de résidence</th>
                            <th class="p-3.5">Rôle</th>
                            <th class="p-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($employes as $emp)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3.5 font-bold text-slate-900">{{ $emp->nom }}</td>
                                <td class="p-3.5 text-slate-600">{{ $emp->email }}</td>
                                <td class="p-3.5">
                                    <span class="px-2.5 py-0.5 rounded bg-indigo-50 text-indigo-700 font-semibold text-xs border border-indigo-200">
                                        {{ $emp->entreprise->nom ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="p-3.5 text-slate-700">{{ $emp->ville_residence }}</td>
                                <td class="p-3.5">
                                    <span class="capitalize font-semibold px-2 py-0.5 rounded bg-slate-100 text-slate-700 text-xs border border-slate-200">
                                        {{ $emp->role }}
                                    </span>
                                </td>
                                <td class="p-3.5 text-right">
                                    <form method="POST" action="{{ route('employes.destroy', $emp) }}" onsubmit="return confirm('Confirmer la suppression ?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-semibold text-rose-600 hover:underline">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-400">Aucun employé enregistré.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
