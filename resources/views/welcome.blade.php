<!DOCTYPE html>
<html lang="fr" class="h-full bg-slate-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CoRide - Covoiturage d'Entreprise</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-800 min-h-screen flex flex-col">

        <!-- Header -->
        <header class="bg-white border-b border-slate-200 px-6 py-4 sticky top-0 z-30">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <div class="w-9 h-9 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-black text-lg shadow-sm">
                        C
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-900">Co<span class="text-indigo-600">Ride</span></span>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-700 hover:bg-slate-100 border border-slate-200 transition">
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg text-xs font-semibold bg-indigo-600 hover:bg-indigo-700 text-white shadow-sm transition">
                        S'inscrire
                    </a>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="flex-1 flex flex-col justify-center items-center px-6 py-16 text-center space-y-8 max-w-4xl mx-auto">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold">
                <span>🌱</span> Covoiturage domicile-travail réservé aux salariés
            </div>

            <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
                Le réseau de covoiturage d'entreprise <span class="text-indigo-600">intelligent & convivial</span>
            </h1>

            <p class="text-slate-600 text-base max-w-2xl leading-relaxed">
                Rejoignez vos collègues des entreprises partenaires (MobiliTech, NextBuild, Atlas Digital, GreenLogix, Kandia Solutions) et bénéficiez de notre brique d'IA pour calculer votre compatibilité de trajet.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-6 py-3 rounded-lg text-sm font-bold bg-indigo-600 hover:bg-indigo-700 text-white shadow-sm transition">
                    S'inscrire avec mon email professionnel &rarr;
                </a>
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-6 py-3 rounded-lg text-sm font-bold bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 transition">
                    Connexion salarié
                </a>
            </div>

            <!-- Features Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-12 text-left w-full">
                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm space-y-2">
                    <div class="text-2xl">🏢</div>
                    <h3 class="font-bold text-base text-slate-900">Salariés Vérifiés</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Accès exclusif aux salariés des entreprises partenaires.</p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm space-y-2">
                    <div class="text-2xl">⚡</div>
                    <h3 class="font-bold text-base text-slate-900">Brique IA Matching</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Analyse la proximité, l'horaire et la récurrence des trajets.</p>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-sm space-y-2">
                    <div class="text-2xl">🎟️</div>
                    <h3 class="font-bold text-base text-slate-900">Règles Métier</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Gestion stricte des réservations et places disponibles.</p>
                </div>
            </div>
        </main>

        <footer class="bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} CoRide. Plateforme de covoiturage d'entreprise Laravel avec IA.</p>
        </footer>

    </body>
</html>
