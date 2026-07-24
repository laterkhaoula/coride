<?php

namespace Database\Seeders;

use App\Models\Entreprise;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class EntrepriseSeeder extends Seeder
{
    public function run(): void
    {
        $defaultCompanies = [
            'MobiliTech',
            'NextBuild',
            'Atlas Digital',
            'GreenLogix',
            'Kandia Solutions',
        ];

        foreach ($defaultCompanies as $company) {
            Entreprise::firstOrCreate(['nom' => $company]);
        }

        $files = File::glob(database_path('data/employes*.csv'));
        if (! empty($files)) {
            $filePath = $files[0];
            $handle = fopen($filePath, 'r');
            $header = fgetcsv($handle);

            while (($data = fgetcsv($handle)) !== false) {
                if (isset($data[3]) && ! empty(trim($data[3]))) {
                    Entreprise::firstOrCreate(['nom' => trim($data[3])]);
                }
            }
            fclose($handle);
        }
    }
}
