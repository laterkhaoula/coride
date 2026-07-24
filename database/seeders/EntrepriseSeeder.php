<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class EntrepriseSeeder extends Seeder
{
    public function run(): void
    {
        $files = File::glob(database_path('data/employes*.csv'));
        if (empty($files)) {
            return;
        }

        $filePath = $files[0];
        $handle = fopen($filePath, 'r');

        // Read header line
        $header = fgetcsv($handle);

        $entreprises = [];
        while (($data = fgetcsv($handle)) !== false) {
            // CSV columns: id,nom,email,entreprise,ville_residence,role
            if (isset($data[3]) && !empty(trim($data[3]))) {
                $entreprises[trim($data[3])] = true;
            }
        }
        fclose($handle);

        foreach (array_keys($entreprises) as $nomEntreprise) {
            Entreprise::firstOrCreate(['nom' => $nomEntreprise]);
        }
    }
}
