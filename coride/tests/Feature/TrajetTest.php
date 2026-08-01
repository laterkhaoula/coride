<?php

namespace Tests\Feature;

use App\Models\Employe;
use App\Models\Entreprise;
use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrajetTest extends TestCase
{
    use RefreshDatabase;

    public function test_driver_can_create_a_trajet()
    {
        $entreprise = Entreprise::create(['nom' => 'TechCorp']);
        $conducteur = Employe::create([
            'nom' => 'Jean Dupont',
            'email' => 'jean@techcorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Paris',
            'role' => 'conducteur',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($conducteur)->post(route('trajets.store'), [
            'ville_depart' => 'Paris',
            'ville_arrivee' => 'Boulogne',
            'horaire' => '08:00',
            'places_disponibles' => 3,
            'jours_recurrence' => 'Lundi, Mardi',
        ]);

        $response->assertRedirect(route('trajets.index'));
        $this->assertDatabaseHas('trajets', [
            'ville_depart' => 'Paris',
            'ville_arrivee' => 'Boulogne',
            'conducteur_id' => $conducteur->id,
        ]);
    }

    public function test_cannot_delete_trajet_with_confirmed_reservations()
    {
        $entreprise = Entreprise::create(['nom' => 'TechCorp']);
        $conducteur = Employe::create([
            'nom' => 'Jean Dupont',
            'email' => 'jean@techcorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Paris',
            'role' => 'conducteur',
            'password' => bcrypt('password'),
        ]);

        $passager = Employe::create([
            'nom' => 'Alice Martin',
            'email' => 'alice@techcorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Paris',
            'role' => 'passager',
            'password' => bcrypt('password'),
        ]);

        $trajet = Trajet::create([
            'conducteur_id' => $conducteur->id,
            'ville_depart' => 'Paris',
            'ville_arrivee' => 'Boulogne',
            'horaire' => '08:00',
            'places_disponibles' => 2,
            'jours_recurrence' => 'Lundi-Vendredi',
        ]);

        Reservation::create([
            'trajet_id' => $trajet->id,
            'passager_id' => $passager->id,
            'statut' => 'confirmee',
            'date_reservation' => now()->toDateString(),
        ]);

        $response = $this->actingAs($conducteur)->delete(route('trajets.destroy', $trajet));

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('trajets', ['id' => $trajet->id]);
    }
}
