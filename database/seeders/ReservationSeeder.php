<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $files = File::glob(database_path('data/reservations*.csv'));
        if (empty($files)) {
            return;
        }

        $filePath = $files[0];
        $handle = fopen($filePath, 'r');

        // Header: id,trajet_id,passager_id,statut,date_reservation
        $header = fgetcsv($handle);

        while (($data = fgetcsv($handle)) !== false) {
            if (count($data) >= 5) {
                Reservation::updateOrCreate(
                    ['id' => trim($data[0])],
                    [
                        'trajet_id' => trim($data[1]),
                        'passager_id' => trim($data[2]),
                        'statut' => trim($data[3]),
                        'date_reservation' => trim($data[4]),
                    ]
                );
            }
        }
        fclose($handle);
    }
}
