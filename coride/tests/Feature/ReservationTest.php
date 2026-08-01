<?php

namespace Tests\Feature;

use App\Models\Employe;
use App\Models\Entreprise;
use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_passenger_can_reserve_available_trajet()
    {
        $entreprise = Entreprise::create(['nom' => 'TechCorp']);
        $conducteur = Employe::create([
            'nom' => 'Jean Conducteur',
            'email' => 'driver@techcorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Paris',
            'role' => 'conducteur',
            'password' => bcrypt('password'),
        ]);

        $passager = Employe::create([
            'nom' => 'Alice Passagere',
            'email' => 'passenger@techcorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Paris',
            'role' => 'passager',
            'password' => bcrypt('password'),
        ]);

        $trajet = Trajet::create([
            'conducteur_id' => $conducteur->id,
            'ville_depart' => 'Paris',
            'ville_arrivee' => 'Orly',
            'horaire' => '07:30',
            'places_disponibles' => 3,
            'jours_recurrence' => 'Lundi-Vendredi',
        ]);

        $response = $this->actingAs($passager)->post(route('reservations.store'), [
            'trajet_id' => $trajet->id,
            'date_reservation' => now()->toDateString(),
        ]);

        $response->assertRedirect(route('reservations.index'));
        $this->assertDatabaseHas('reservations', [
            'trajet_id' => $trajet->id,
            'passager_id' => $passager->id,
            'statut' => 'en_attente',
        ]);
    }

    public function test_passenger_cannot_reserve_same_trajet_twice()
    {
        $entreprise = Entreprise::create(['nom' => 'TechCorp']);
        $conducteur = Employe::create([
            'nom' => 'Jean Conducteur',
            'email' => 'driver@techcorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Paris',
            'role' => 'conducteur',
            'password' => bcrypt('password'),
        ]);

        $passager = Employe::create([
            'nom' => 'Alice Passagere',
            'email' => 'passenger@techcorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Paris',
            'role' => 'passager',
            'password' => bcrypt('password'),
        ]);

        $trajet = Trajet::create([
            'conducteur_id' => $conducteur->id,
            'ville_depart' => 'Paris',
            'ville_arrivee' => 'Orly',
            'horaire' => '07:30',
            'places_disponibles' => 3,
            'jours_recurrence' => 'Lundi-Vendredi',
        ]);

        Reservation::create([
            'trajet_id' => $trajet->id,
            'passager_id' => $passager->id,
            'statut' => 'en_attente',
            'date_reservation' => now()->toDateString(),
        ]);

        $response = $this->actingAs($passager)->post(route('reservations.store'), [
            'trajet_id' => $trajet->id,
            'date_reservation' => now()->toDateString(),
        ]);

        $response->assertSessionHasErrors('trajet_id');
    }

    public function test_cannot_reserve_full_trajet()
    {
        $entreprise = Entreprise::create(['nom' => 'TechCorp']);
        $conducteur = Employe::create([
            'nom' => 'Jean Conducteur',
            'email' => 'driver@techcorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Paris',
            'role' => 'conducteur',
            'password' => bcrypt('password'),
        ]);

        $passager1 = Employe::create([
            'nom' => 'Passager 1',
            'email' => 'p1@techcorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Paris',
            'role' => 'passager',
            'password' => bcrypt('password'),
        ]);

        $passager2 = Employe::create([
            'nom' => 'Passager 2',
            'email' => 'p2@techcorp.com',
            'entreprise_id' => $entreprise->id,
            'ville_residence' => 'Paris',
            'role' => 'passager',
            'password' => bcrypt('password'),
        ]);

        $trajet = Trajet::create([
            'conducteur_id' => $conducteur->id,
            'ville_depart' => 'Paris',
            'ville_arrivee' => 'Orly',
            'horaire' => '07:30',
            'places_disponibles' => 1,
            'jours_recurrence' => 'Lundi-Vendredi',
        ]);

        // Confirm 1 reservation to fill the 1 available seat
        Reservation::create([
            'trajet_id' => $trajet->id,
            'passager_id' => $passager1->id,
            'statut' => 'confirmee',
            'date_reservation' => now()->toDateString(),
        ]);

        $response = $this->actingAs($passager2)->post(route('reservations.store'), [
            'trajet_id' => $trajet->id,
            'date_reservation' => now()->toDateString(),
        ]);

        $response->assertSessionHasErrors('trajet_id');
    }
}
