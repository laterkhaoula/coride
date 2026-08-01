<?php

namespace Database\Seeders;

use App\Models\Trajet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TrajetSeeder extends Seeder
{
    public function run(): void
    {
        $files = File::glob(database_path('data/trajets*.csv'));
        if (empty($files)) {
            return;
        }

        $filePath = $files[0];
        $handle = fopen($filePath, 'r');

        // Header: id,conducteur_id,ville_depart,ville_arrivee,horaire,places_disponibles,jours_recurrence
        $header = fgetcsv($handle);

        while (($data = fgetcsv($handle)) !== false) {
            if (count($data) >= 7) {
                Trajet::updateOrCreate(
                    ['id' => trim($data[0])],
                    [
                        'conducteur_id' => trim($data[1]),
                        'ville_depart' => trim($data[2]),
                        'ville_arrivee' => trim($data[3]),
                        'horaire' => trim($data[4]),
                        'places_disponibles' => (int) trim($data[5]),
                        'jours_recurrence' => trim($data[6]),
                    ]
                );
            }
        }
        fclose($handle);
    }
}
