<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-black text-2xl text-slate-900 dark:text-white leading-tight">
                    Gestion des Employés
                </h2>
                <p class="text-sm text-slate-500 mt-1">Annuaire des salariés inscrits sur CoRide</p>
            </div>
            <a href="{{ route('employes.create') }}" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-md transition">
                + Ajouter un employé
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

            <div class="p-6 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600 dark:text-slate-300">
                        <thead class="text-xs uppercase bg-slate-50 dark:bg-slate-800/60 text-slate-400 font-bold">
                            <tr>
                                <th class="p-4 rounded-l-xl">Nom</th>
                                <th class="p-4">Email</th>
                                <th class="p-4">Entreprise</th>
                                <th class="p-4">Ville de résidence</th>
                                <th class="p-4">Rôle</th>
                                <th class="p-4 text-right rounded-r-xl">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse($employes as $emp)
                                <tr>
                                    <td class="p-4 font-bold text-slate-900 dark:text-white">{{ $emp->nom }}</td>
                                    <td class="p-4">{{ $emp->email }}</td>
                                    <td class="p-4"><span class="px-2.5 py-1 rounded-md bg-indigo-50 dark:bg-indigo-950 text-indigo-700 dark:text-indigo-300 font-semibold text-xs">{{ $emp->entreprise->nom ?? 'N/A' }}</span></td>
                                    <td class="p-4">{{ $emp->ville_residence }}</td>
                                    <td class="p-4"><span class="capitalize font-medium px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs">{{ $emp->role }}</span></td>
                                    <td class="p-4 text-right">
                                        <form method="POST" action="{{ route('employes.destroy', $emp) }}" onsubmit="return confirm('Confirmer la suppression ?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-semibold text-rose-600 hover:underline">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-slate-400">Aucun employé trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
