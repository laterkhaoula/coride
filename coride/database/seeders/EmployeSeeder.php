<?php

namespace Database\Seeders;

use App\Models\Employe;
use App\Models\Entreprise;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class EmployeSeeder extends Seeder
{
    public function run(): void
    {
        $files = File::glob(database_path('data/employes*.csv'));
        if (empty($files)) {
            return;
        }

        $filePath = $files[0];
        $handle = fopen($filePath, 'r');

        // Read header line: id,nom,email,entreprise,ville_residence,role
        $header = fgetcsv($handle);

        $defaultPassword = Hash::make('password');

        while (($data = fgetcsv($handle)) !== false) {
            if (count($data) >= 6) {
                $id = trim($data[0]);
                $nom = trim($data[1]);
                $email = trim($data[2]);
                $nomEntreprise = trim($data[3]);
                $villeResidence = trim($data[4]);
                $role = trim($data[5]);

                $entreprise = Entreprise::where('nom', $nomEntreprise)->first();

                Employe::updateOrCreate(
                    ['id' => $id],
                    [
                        'nom' => $nom,
                        'email' => $email,
                        'entreprise_id' => $entreprise ? $entreprise->id : 1,
                        'ville_residence' => $villeResidence,
                        'role' => $role,
                        'password' => $defaultPassword,
                    ]
                );
            }
        }
        fclose($handle);
    }
}
