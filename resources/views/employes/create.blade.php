<x-app-layout>
 <x-slot name="header">
 <h2 class="font-bold text-2xl text-slate-900 leading-tight">
 Ajouter un Employé
 </h2>
 </x-slot>

 <div class="py-8 bg-slate-50 min-h-screen">
 <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
 <div class="p-8 rounded-xl bg-white border border-slate-200/80 shadow-sm">
 
 <form method="POST" action="{{ route('employes.store') }}" class="space-y-6">
 @csrf

 <div>
 <x-input-label for="nom" value="Nom complet" />
 <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required />
 <x-input-error :messages="$errors->get('nom')" class="mt-2" />
 </div>

 <div>
 <x-input-label for="email" value="Email professionnel" />
 <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
 <x-input-error :messages="$errors->get('email')" class="mt-2" />
 </div>

 <div>
 <x-input-label for="entreprise_id" value="Entreprise" />
 <select id="entreprise_id" name="entreprise_id" class="block mt-1 w-full border-slate-300 rounded-md shadow-sm" required>
 @foreach($entreprises as $ent)
 <option value="{{ $ent->id }}">{{ $ent->nom }}</option>
 @endforeach
 </select>
 <x-input-error :messages="$errors->get('entreprise_id')" class="mt-2" />
 </div>

 <div>
 <x-input-label for="ville_residence" value="Ville de résidence" />
 <x-text-input id="ville_residence" class="block mt-1 w-full" type="text" name="ville_residence" :value="old('ville_residence')" required />
 <x-input-error :messages="$errors->get('ville_residence')" class="mt-2" />
 </div>

 <div>
 <x-input-label for="role" value="Rôle" />
 <select id="role" name="role" class="block mt-1 w-full border-slate-300 rounded-md shadow-sm" required>
 <option value="passager">Passager</option>
 <option value="conducteur">Conducteur</option>
 <option value="les deux">Les deux</option>
 </select>
 <x-input-error :messages="$errors->get('role')" class="mt-2" />
 </div>

 <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-100">
 <a href="{{ route('employes.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">Annuler</a>
 <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-semibold text-sm rounded-lg shadow-md">
 Enregistrer
 </button>
 </div>
 </form>

 </div>
 </div>
 </div>
</x-app-layout>
