<?php

namespace Tests\Unit;

use App\Casts\CompatibilityScoreCast;
use App\Models\Employe;
use App\Models\Entreprise;
use App\Models\ResultatIA;
use App\Models\Trajet;
use App\Services\AiCompatibilityService;
use App\ValueObjects\CompatibilityResult;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AiCompatibilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_ai_compatibility_service_calculates_score_and_justification()
    {
        $entreprise = Entreprise::create(['nom' => 'EcoCorp']);
        $conducteur = Employe::create([
            'nom' => 'Pierre Conducteur',
            'email' => 'pierre@ecocorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Lyon',
            'role' => 'conducteur',
            'password' => bcrypt('password'),
        ]);

        $passager = Employe::create([
            'nom' => 'Sophie Passagere',
            'email' => 'sophie@ecocorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Lyon',
            'role' => 'passager',
            'password' => bcrypt('password'),
        ]);

        $trajet = Trajet::create([
            'conducteur_id' => $conducteur->id,
            'ville_depart' => 'Lyon',
            'ville_arrivee' => 'Villeurbanne',
            'horaire' => '08:30',
            'places_disponibles' => 3,
            'jours_recurrence' => 'Lundi, Mardi, Mercredi, Jeudi, Vendredi',
        ]);

        $aiService = new AiCompatibilityService();
        $compatibility = $aiService->evaluateCompatibility($passager, $trajet);

        $this->assertInstanceOf(CompatibilityResult::class, $compatibility);
        $this->assertGreaterThanOrEqual(80, $compatibility->score);
        $this->assertStringContainsString('Analyse IA CoRide', $compatibility->justification);
        $this->assertStringContainsString('Point de départ idéal', $compatibility->justification);
    }

    public function test_custom_eloquent_cast_returns_compatibility_result_object()
    {
        $entreprise = Entreprise::create(['nom' => 'EcoCorp']);
        $conducteur = Employe::create([
            'nom' => 'Pierre',
            'email' => 'p@ecocorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Lyon',
            'role' => 'conducteur',
            'password' => bcrypt('password'),
        ]);

        $passager = Employe::create([
            'nom' => 'Sophie',
            'email' => 's@ecocorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Lyon',
            'role' => 'passager',
            'password' => bcrypt('password'),
        ]);

        $trajet = Trajet::create([
            'conducteur_id' => $conducteur->id,
            'ville_depart' => 'Lyon',
            'ville_arrivee' => 'Villeurbanne',
            'horaire' => '08:30',
            'places_disponibles' => 3,
            'jours_recurrence' => 'Lundi-Vendredi',
        ]);

        $resultat = ResultatIA::create([
            'trajet_id' => $trajet->id,
            'passager_id' => $passager->id,
            'score' => 95,
            'justification' => 'Compatibilité maximale détectée.',
        ]);

        $this->assertInstanceOf(CompatibilityResult::class, $resultat->compatibility);
        $this->assertEquals(95, $resultat->compatibility->score);
        $this->assertEquals('Excellente compatibilité', $resultat->compatibility->getBadgeLabel());
    }
}
