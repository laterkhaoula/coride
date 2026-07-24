<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-900 dark:text-white leading-tight">
            Modifier le trajet #{{ $trajet->id }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-8 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800 shadow-sm">
                
                <form method="POST" action="{{ route('trajets.update', $trajet) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="ville_depart" value="Ville de départ" />
                        <x-text-input id="ville_depart" class="block mt-1 w-full" type="text" name="ville_depart" :value="old('ville_depart', $trajet->ville_depart)" required />
                        <x-input-error :messages="$errors->get('ville_depart')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="ville_arrivee" value="Ville d'arrivée" />
                        <x-text-input id="ville_arrivee" class="block mt-1 w-full" type="text" name="ville_arrivee" :value="old('ville_arrivee', $trajet->ville_arrivee)" required />
                        <x-input-error :messages="$errors->get('ville_arrivee')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="horaire" value="Horaire de départ" />
                        <x-text-input id="horaire" class="block mt-1 w-full" type="text" name="horaire" :value="old('horaire', $trajet->horaire)" required />
                        <x-input-error :messages="$errors->get('horaire')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="places_disponibles" value="Nombre de places disponibles" />
                        <x-text-input id="places_disponibles" class="block mt-1 w-full" type="number" name="places_disponibles" :value="old('places_disponibles', $trajet->places_disponibles)" min="1" max="8" required />
                        <x-input-error :messages="$errors->get('places_disponibles')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="jours_recurrence" value="Jours de récurrence" />
                        <x-text-input id="jours_recurrence" class="block mt-1 w-full" type="text" name="jours_recurrence" :value="old('jours_recurrence', $trajet->jours_recurrence)" required />
                        <x-input-error :messages="$errors->get('jours_recurrence')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                        <a href="{{ route('trajets.show', $trajet) }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 dark:text-slate-400">Annuler</a>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-md transition">
                            Mettre à jour
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
