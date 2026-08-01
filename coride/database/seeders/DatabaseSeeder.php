<?php

namespace Database\Seeders;

use App\Models\Employe;
use App\Models\Trajet;
use App\Services\AiCompatibilityService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EntrepriseSeeder::class,
            EmployeSeeder::class,
            TrajetSeeder::class,
            ReservationSeeder::class,
        ]);

        // Evaluate AI compatibility for seeded passenger employees
        $aiService = app(AiCompatibilityService::class);
        $passagers = Employe::whereIn('role', ['passager', 'les deux'])->get();
        $trajets = Trajet::all();

        foreach ($passagers as $passager) {
            foreach ($trajets as $trajet) {
                if ($trajet->conducteur_id !== $passager->id) {
                    $aiService->evaluateCompatibility($passager, $trajet);
                }
            }
        }
    }
}
