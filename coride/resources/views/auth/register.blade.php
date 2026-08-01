<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Inscription CoRide</h2>
        <p class="text-sm text-slate-600 dark:text-slate-400">Rejoignez la communauté de covoiturage de votre entreprise</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom complet -->
        <div>
            <x-input-label for="nom" value="Nom complet" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required autofocus />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <!-- Email Professionnel -->
        <div class="mt-4">
            <x-input-label for="email" value="Email professionnel" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Entreprise -->
        <div class="mt-4">
            <x-input-label for="entreprise_id" value="Entreprise partenaire" />
            <select id="entreprise_id" name="entreprise_id" class="block mt-1 w-full border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">-- Sélectionner votre entreprise --</option>
                @foreach($entreprises as $entreprise)
                    <option value="{{ $entreprise->id }}" {{ old('entreprise_id') == $entreprise->id ? 'selected' : '' }}>
                        {{ $entreprise->nom }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('entreprise_id')" class="mt-2" />
        </div>

        <!-- Ville de résidence -->
        <div class="mt-4">
            <x-input-label for="ville_residence" value="Ville de résidence" />
            <x-text-input id="ville_residence" class="block mt-1 w-full" type="text" name="ville_residence" :value="old('ville_residence')" placeholder="Ex: Paris, Boulogne-Billancourt..." required />
            <x-input-error :messages="$errors->get('ville_residence')" class="mt-2" />
        </div>

        <!-- Rôle -->
        <div class="mt-4">
            <x-input-label for="role" value="Rôle au sein de la plateforme" />
            <select id="role" name="role" class="block mt-1 w-full border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="passager" {{ old('role') == 'passager' ? 'selected' : '' }}>Passager (Je recherche des trajets)</option>
                <option value="conducteur" {{ old('role') == 'conducteur' ? 'selected' : '' }}>Conducteur (Je propose des trajets)</option>
                <option value="les deux" {{ old('role') == 'les deux' ? 'selected' : '' }}>Les deux (Conducteur & Passager)</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100 underline" href="{{ route('login') }}">
                Déjà inscrit ?
            </a>

            <x-primary-button class="ms-4">
                S'inscrire
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
