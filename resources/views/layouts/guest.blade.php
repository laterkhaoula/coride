<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CoRide') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50">
            <div>
                <a href="/" class="flex items-center gap-2">
                    <span class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center text-white">
                        <x-icon name="car" class="w-6 h-6" />
                    </span>
                    <span class="text-2xl font-bold text-slate-900">Co<span class="text-blue-600">Ride</span></span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white border border-slate-200 shadow-sm sm:rounded-xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
