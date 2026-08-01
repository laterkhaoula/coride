<!DOCTYPE html>
<html lang="fr" class="scroll-smooth h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CoRide - Covoiturage intelligent entre entreprises</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white text-[#111827]" x-data="{ scrolled: false, mobileOpen: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 8)">

        <!-- ============ NAVBAR ============ -->
        <header
            class="fixed top-0 left-0 right-0 z-50 bg-white transition-shadow duration-300"
            :class="scrolled ? 'shadow-sm' : ''"
        >
            <nav class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <span class="w-9 h-9 rounded-xl bg-[#2563EB] flex items-center justify-center text-white font-bold text-sm">CR</span>
                    <span class="text-xl font-bold tracking-tight text-[#111827]">CoRide</span>
                </a>

                <div class="hidden md:flex items-center gap-10 text-sm font-medium text-[#111827]">
                    <a href="#accueil" class="hover:text-[#2563EB] transition-colors duration-200">Accueil</a>
                    <a href="#fonctionnalites" class="hover:text-[#2563EB] transition-colors duration-200">Fonctionnalités</a>
                    <a href="#entreprises" class="hover:text-[#2563EB] transition-colors duration-200">Entreprises</a>
                    <a href="#comment-ca-marche" class="hover:text-[#2563EB] transition-colors duration-200">Comment ça marche</a>
                </div>

                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-[#111827] hover:text-[#2563EB] transition-colors duration-200">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold bg-[#111827] text-white hover:bg-[#2563EB] transition-colors duration-200">
                        S'inscrire
                    </a>
                </div>

                <!-- Mobile toggle -->
                <button @click="mobileOpen = !mobileOpen" class="md:hidden w-10 h-10 flex items-center justify-center rounded-xl hover:bg-[#F8FAFC]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#111827]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </nav>

            <!-- Mobile menu -->
            <div x-show="mobileOpen" x-cloak x-transition class="md:hidden bg-white border-t border-[#F8FAFC] px-6 py-6 space-y-4">
                <a href="#accueil" @click="mobileOpen = false" class="block text-sm font-medium text-[#111827]">Accueil</a>
                <a href="#fonctionnalites" @click="mobileOpen = false" class="block text-sm font-medium text-[#111827]">Fonctionnalités</a>
                <a href="#entreprises" @click="mobileOpen = false" class="block text-sm font-medium text-[#111827]">Entreprises</a>
                <a href="#comment-ca-marche" @click="mobileOpen = false" class="block text-sm font-medium text-[#111827]">Comment ça marche</a>
                <div class="pt-4 flex flex-col gap-3">
                    <a href="{{ route('login') }}" class="w-full text-center px-5 py-2.5 rounded-xl text-sm font-semibold border border-[#F8FAFC] bg-[#F8FAFC] text-[#111827]">Connexion</a>
                    <a href="{{ route('register') }}" class="w-full text-center px-5 py-2.5 rounded-xl text-sm font-semibold bg-[#111827] text-white">S'inscrire</a>
                </div>
            </div>
        </header>

        <!-- ============ HERO ============ -->
        <section id="accueil" class="relative pt-20">
            <div class="relative h-[380px] flex items-center justify-center overflow-hidden">
                <img
                    src="/images/hero_carpool_highway.png"
                    alt="Covoiturage entre entreprises"
                    class="absolute inset-0 w-full h-full object-cover object-center"
                >
                <div class="absolute inset-0 bg-white/60"></div>
                <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-b from-transparent to-white"></div>

                <div class="relative z-10 max-w-2xl mx-auto text-center px-6 space-y-5">
                    <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-[#111827] leading-tight">
                        Le covoiturage intelligent<br class="hidden sm:block"> pour votre entreprise
                    </h1>
                    <p class="text-base text-[#111827]/70 max-w-lg mx-auto">
                        Une plateforme pour gérer les trajets partagés de vos salariés, quelle que soit la taille de votre entreprise.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('register') }}" class="inline-block px-7 py-3.5 rounded-xl text-sm font-semibold bg-[#111827] text-white hover:bg-[#2563EB] transition-colors duration-200">
                            Commencer gratuitement
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ SECTION 2 : Plateforme complète ============ -->
        <section class="bg-white py-24 px-6">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-bold text-[#111827] mb-16">
                    Une plateforme complète pour les salariés
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                    <div>
                        <div class="w-32 h-32 rounded-full bg-[#F8FAFC] flex items-center justify-center mb-6">
                            <svg viewBox="0 0 100 100" class="w-20 h-20">
                                <circle cx="50" cy="52" r="26" fill="#DCE3F0"/>
                                <path d="M32 62 q18 -14 36 0 v14 q-18 10 -36 0 z" fill="#111827"/>
                                <circle cx="50" cy="38" r="12" fill="#F3C7A4"/>
                                <path d="M38 66 L50 52 L62 66" stroke="#2563EB" stroke-width="3" fill="none" stroke-linecap="round"/>
                                <rect x="30" y="70" width="40" height="8" rx="4" fill="#2563EB"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-[#111827] mb-3">Trajets</h3>
                        <p class="text-base text-[#6B7280] leading-relaxed mb-4">
                            Le trajet du matin, le retour du soir. Quand vos salariés se déplacent, un trajet peut être proposé ou réservé entre collègues d'une même entreprise.
                        </p>
                        <a href="#comment-ca-marche" class="text-sm font-semibold text-[#111827] underline underline-offset-4 hover:text-[#2563EB] transition-colors duration-200">
                            En savoir plus
                        </a>
                    </div>

                    <div>
                        <div class="w-32 h-32 rounded-full bg-[#F8FAFC] flex items-center justify-center mb-6">
                            <svg viewBox="0 0 100 100" class="w-20 h-20">
                                <circle cx="50" cy="50" r="30" fill="#DCE3F0"/>
                                <rect x="34" y="30" width="32" height="46" rx="6" fill="#111827"/>
                                <rect x="39" y="38" width="22" height="26" rx="2" fill="#FFFFFF"/>
                                <circle cx="50" cy="70" r="3" fill="#FFFFFF"/>
                                <path d="M50 44 l6 8 h-4 l0 8 h-4 v-8 h-4 z" fill="#2563EB"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-[#111827] mb-3">Matching IA</h3>
                        <p class="text-base text-[#6B7280] leading-relaxed mb-4">
                            Notre algorithme analyse la proximité, les horaires et la régularité des trajets pour proposer les meilleurs compagnons de route.
                        </p>
                        <a href="#ia" class="text-sm font-semibold text-[#111827] underline underline-offset-4 hover:text-[#2563EB] transition-colors duration-200">
                            En savoir plus
                        </a>
                    </div>

                    <div>
                        <div class="w-32 h-32 rounded-full bg-[#F8FAFC] flex items-center justify-center mb-6">
                            <svg viewBox="0 0 100 100" class="w-20 h-20">
                                <circle cx="50" cy="50" r="30" fill="#DCE3F0"/>
                                <path d="M50 26 l20 8 v18 c0 16 -9 26 -20 30 c-11 -4 -20 -14 -20 -30 v-18 z" fill="#111827"/>
                                <path d="M40 52 l7 7 l14 -16" stroke="#2563EB" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-[#111827] mb-3">Entreprises</h3>
                        <p class="text-base text-[#6B7280] leading-relaxed mb-4">
                            Seuls les salariés rattachés à une entreprise partenaire peuvent rejoindre la plateforme, pour des trajets entre collègues de confiance.
                        </p>
                        <a href="#entreprises" class="text-sm font-semibold text-[#111827] underline underline-offset-4 hover:text-[#2563EB] transition-colors duration-200">
                            En savoir plus
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ FONCTIONNALITES (6 cartes) ============ -->
        <section id="fonctionnalites" class="bg-[#F8FAFC] py-24 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16 space-y-4">
                    <h2 class="text-3xl sm:text-4xl font-bold text-[#111827]">Fonctionnalités</h2>
                    <p class="text-xl text-[#6B7280] max-w-2xl mx-auto">Tout ce dont vos équipes ont besoin pour covoiturer sereinement.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                        $features = [
                            ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Réservation en temps réel', 'desc' => 'Réservez une place disponible instantanément, sans attente ni confirmation manuelle.'],
                            ['icon' => 'M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z M9 10a3 3 0 106 0 3 3 0 00-6 0z', 'title' => 'Suivi des itinéraires', 'desc' => 'Visualisez le trajet, les points de rendez-vous et les horaires estimés en un coup d\'œil.'],
                            ['icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'title' => 'Profils vérifiés', 'desc' => 'Chaque salarié est rattaché à son entreprise, pour des trajets en toute confiance.'],
                            ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'title' => 'Planning partagé', 'desc' => 'Consultez et publiez vos trajets récurrents pour toute la semaine en un seul geste.'],
                            ['icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'title' => 'Statistiques d\'impact', 'desc' => 'Suivez les kilomètres partagés et le CO2 économisé grâce à vos trajets communs.'],
                            ['icon' => 'M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8z', 'title' => 'Sécurité des données', 'desc' => 'Vos informations et celles de votre entreprise restent protégées et confidentielles.'],
                        ];
                    @endphp

                    @foreach ($features as $feature)
                        <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                            <div class="w-12 h-12 rounded-xl bg-[#2563EB]/10 flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#2563EB]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-[#111827] mb-2">{{ $feature['title'] }}</h3>
                            <p class="text-base text-[#6B7280] leading-relaxed">{{ $feature['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============ COMMENT CA MARCHE ============ -->
        <section id="comment-ca-marche" class="bg-white py-24 px-6">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-bold text-[#111827] text-center mb-20">Comment ça marche</h2>

                <div class="flex flex-col md:flex-row items-center justify-between gap-8 md:gap-4">
                    @php
                        $steps = [
                            ['n' => '1', 't' => 'Créer un compte'],
                            ['n' => '2', 't' => 'Publier un trajet'],
                            ['n' => '3', 't' => 'Réserver un trajet'],
                            ['n' => '4', 't' => 'Voyager ensemble'],
                        ];
                    @endphp

                    @foreach ($steps as $i => $step)
                        <div class="flex flex-col md:flex-row items-center gap-4 md:gap-4 w-full md:w-auto">
                            <div class="flex flex-col items-center text-center gap-4">
                                <div class="w-16 h-16 rounded-full bg-[#F8FAFC] flex items-center justify-center text-xl font-bold text-[#2563EB]">
                                    {{ $step['n'] }}
                                </div>
                                <p class="text-base font-semibold text-[#111827]">{{ $step['t'] }}</p>
                            </div>

                            @if (!$loop->last)
                                <div class="hidden md:block text-[#6B7280]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </div>
                                <div class="md:hidden text-[#6B7280]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============ ENTREPRISES PARTENAIRES ============ -->
        <section id="entreprises" class="bg-[#F8FAFC] py-24 px-6">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-bold text-[#111827] text-center mb-16">Entreprises partenaires</h2>

                <div class="grid grid-cols-2 md:grid-cols-5 gap-8 items-center justify-items-center">
                    @foreach (['MobiliTech', 'NextBuild', 'Atlas Digital', 'GreenLogix', 'Kandia Solutions'] as $entreprise)
                        <div class="text-lg font-bold text-[#6B7280] tracking-tight opacity-70 hover:opacity-100 transition-opacity duration-300">
                            {{ $entreprise }}
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============ SECTION IA ============ -->
        <section id="ia" class="bg-white py-24 px-6">
            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="rounded-xl overflow-hidden">
                    <img src="/images/scenic_road_commute.png" alt="Matching intelligent" class="w-full h-[420px] object-cover rounded-xl">
                </div>

                <div class="space-y-8">
                    <h2 class="text-3xl sm:text-4xl font-bold text-[#111827] leading-tight">
                        Matching intelligent grâce à l'IA
                    </h2>
                    <p class="text-xl text-[#6B7280] leading-relaxed">
                        Notre moteur analyse en temps réel la proximité des trajets, les horaires d'embauche et la régularité des jours pour proposer les meilleurs compagnons de route.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4">
                        <div class="bg-[#F8FAFC] rounded-xl p-6">
                            <p class="text-base font-semibold text-[#111827] mb-1">Compatibilité</p>
                            <p class="text-sm text-[#6B7280]">Score calculé selon les habitudes de chacun.</p>
                        </div>
                        <div class="bg-[#F8FAFC] rounded-xl p-6">
                            <p class="text-base font-semibold text-[#111827] mb-1">Distance</p>
                            <p class="text-sm text-[#6B7280]">Optimisation du trajet le plus court commun.</p>
                        </div>
                        <div class="bg-[#F8FAFC] rounded-xl p-6">
                            <p class="text-base font-semibold text-[#111827] mb-1">Horaires</p>
                            <p class="text-sm text-[#6B7280]">Alignement des créneaux d'arrivée et de départ.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============ STATISTIQUES ============ -->
        <section class="bg-[#111827] py-24 px-6">
            <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
                <div>
                    <p class="text-4xl sm:text-5xl font-bold text-white mb-2">500+</p>
                    <p class="text-base text-[#6B7280]">Employés</p>
                </div>
                <div>
                    <p class="text-4xl sm:text-5xl font-bold text-white mb-2">25</p>
                    <p class="text-base text-[#6B7280]">Entreprises</p>
                </div>
                <div>
                    <p class="text-4xl sm:text-5xl font-bold text-white mb-2">1400+</p>
                    <p class="text-base text-[#6B7280]">Trajets</p>
                </div>
                <div>
                    <p class="text-4xl sm:text-5xl font-bold text-white mb-2">98%</p>
                    <p class="text-base text-[#6B7280]">Compatibilité</p>
                </div>
            </div>
        </section>

        <!-- ============ TEMOIGNAGES ============ -->
        <section class="bg-white py-24 px-6">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-bold text-[#111827] text-center mb-16">Ce que disent nos salariés</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @php
                        $testimonials = [
                            ['name' => 'Sara Amrani', 'company' => 'MobiliTech', 'text' => 'Je partage mon trajet avec deux collègues chaque jour, ça change vraiment mon quotidien.', 'initials' => 'SA'],
                            ['name' => 'Yassine Bennani', 'company' => 'Atlas Digital', 'text' => 'Le matching par IA me propose toujours des trajets proches de mes horaires exacts.', 'initials' => 'YB'],
                            ['name' => 'Nadia El Fassi', 'company' => 'GreenLogix', 'text' => 'Simple, rapide et je fais des économies de carburant chaque mois.', 'initials' => 'NE'],
                        ];
                    @endphp

                    @foreach ($testimonials as $t)
                        <div class="bg-[#F8FAFC] rounded-xl p-8">
                            <div class="w-12 h-12 rounded-full bg-[#2563EB]/10 text-[#2563EB] font-semibold flex items-center justify-center mb-6">
                                {{ $t['initials'] }}
                            </div>
                            <p class="text-base text-[#111827] leading-relaxed mb-6">&ldquo;{{ $t['text'] }}&rdquo;</p>
                            <p class="text-sm font-semibold text-[#111827]">{{ $t['name'] }}</p>
                            <p class="text-sm text-[#6B7280]">{{ $t['company'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ============ CTA FINAL ============ -->
        <section class="bg-[#2563EB] py-20 px-6">
            <div class="max-w-3xl mx-auto text-center space-y-6">
                <h2 class="text-3xl sm:text-4xl font-bold text-white">Prêt à covoiturer avec vos collègues ?</h2>
                <p class="text-lg text-white/80">Rejoignez votre entreprise sur CoRide et trouvez votre premier trajet dès aujourd'hui.</p>
                <a href="{{ route('register') }}" class="inline-block px-8 py-4 rounded-xl text-sm font-semibold bg-white text-[#111827] hover:bg-[#111827] hover:text-white transition-colors duration-200">
                    Commencer maintenant
                </a>
            </div>
        </section>

        <!-- ============ FOOTER ============ -->
        <footer class="bg-[#111827] text-white py-16 px-6">
            <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-12">
                <div class="col-span-2 md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-9 h-9 rounded-xl bg-[#2563EB] flex items-center justify-center text-white font-bold text-sm">CR</span>
                        <span class="text-xl font-bold">CoRide</span>
                    </div>
                    <p class="text-sm text-[#6B7280] leading-relaxed">Covoiturage intelligent entre entreprises.</p>
                </div>

                <div>
                    <p class="text-sm font-semibold text-white mb-4">Produit</p>
                    <ul class="space-y-3 text-sm text-[#6B7280]">
                        <li><a href="#fonctionnalites" class="hover:text-white transition-colors duration-200">Fonctionnalités</a></li>
                        <li><a href="#comment-ca-marche" class="hover:text-white transition-colors duration-200">Comment ça marche</a></li>
                        <li><a href="#ia" class="hover:text-white transition-colors duration-200">Matching IA</a></li>
                    </ul>
                </div>

                <div>
                    <p class="text-sm font-semibold text-white mb-4">Entreprise</p>
                    <ul class="space-y-3 text-sm text-[#6B7280]">
                        <li><a href="#entreprises" class="hover:text-white transition-colors duration-200">Nos partenaires</a></li>
                        <li><a href="#accueil" class="hover:text-white transition-colors duration-200">À propos</a></li>
                    </ul>
                </div>

                <div>
                    <p class="text-sm font-semibold text-white mb-4">Compte</p>
                    <ul class="space-y-3 text-sm text-[#6B7280]">
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors duration-200">Connexion</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-colors duration-200">S'inscrire</a></li>
                    </ul>
                </div>
            </div>

            <div class="max-w-7xl mx-auto mt-12 pt-8 border-t border-white/10 text-sm text-[#6B7280] text-center">
                &copy; {{ date('Y') }} CoRide. Tous droits réservés.
            </div>
        </footer>

    </body>
</html>
