<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CoRide') }} - Covoiturage d'Entreprise</title>

        <!-- Fonts: Plus Jakarta Sans & Outfit -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 min-h-full flex flex-col selection:bg-indigo-500 selection:text-white">
        <!-- Top Road Stripe Banner -->
        <div class="h-1.5 w-full bg-gradient-to-r from-emerald-500 via-indigo-600 to-cyan-500"></div>

        <div class="min-h-screen flex flex-col flex-1 bg-slate-50 dark:bg-slate-950">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200/60 dark:border-slate-800/60 sticky top-0 z-30 shadow-sm">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-slate-900 border-t border-slate-200/80 dark:border-slate-800 py-6 mt-12 text-center text-xs text-slate-500 dark:text-slate-400">
                <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-lg bg-indigo-600 text-white font-bold flex items-center justify-center text-xs">C</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200">CoRide Platform</span>
                        <span class="text-slate-400">&bull;</span>
                        <span>Covoiturage domicile-travail écoresponsable</span>
                    </div>
                    <p>&copy; {{ date('Y') }} CoRide - Tous droits réservés. Propulsé par Laravel & IA.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
