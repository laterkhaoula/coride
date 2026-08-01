<x-app-layout>
 <x-slot name="header">
 <h2 class="font-bold text-2xl text-slate-900 leading-tight">
 Ajouter une Entreprise Partenaire
 </h2>
 </x-slot>

 <div class="py-8 bg-slate-50 min-h-screen">
 <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
 <div class="p-8 rounded-xl bg-white border border-slate-200/80 shadow-sm">
 
 <form method="POST" action="{{ route('entreprises.store') }}" class="space-y-6">
 @csrf

 <div>
 <x-input-label for="nom" value="Raison Sociale / Nom de l'entreprise" />
 <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" placeholder="Ex: TechCorp" required />
 <x-input-error :messages="$errors->get('nom')" class="mt-2" />
 </div>

 <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-100">
 <a href="{{ route('entreprises.index') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">Annuler</a>
 <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-semibold text-sm rounded-lg shadow-md">
 Ajouter
 </button>
 </div>
 </form>

 </div>
 </div>
 </div>
</x-app-layout>
