<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CoRide') }} - Plateforme de Covoiturage d'Entreprise</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">

        <!-- Vite Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-800 min-h-full flex flex-col">
        <!-- Top Accent Line -->
        <div class="h-1 w-full bg-indigo-600"></div>

        <div class="min-h-screen flex flex-col flex-1">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/80">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>

            <!-- Clean Footer -->
            <footer class="bg-white/80 backdrop-blur-md border-t border-slate-200/80 py-6 text-xs text-slate-500">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center space-x-2">
                        <span class="w-6 h-6 rounded bg-indigo-600 text-white font-bold flex items-center justify-center text-xs">C</span>
                        <span class="font-bold text-slate-700">CoRide Platform</span>
                        <span class="text-slate-300">&bull;</span>
                        <span>Covoiturage d'Entreprise réservé aux salariés</span>
                    </div>
                    <p>&copy; {{ date('Y') }} CoRide. Tous droits réservés.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
