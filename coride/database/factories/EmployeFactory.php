<?php

namespace Database\Factories;

use App\Models\Employe;
use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    protected $model = Employe::class;

    public function definition(): array
    {
        return [
            'nom' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'entreprise_id' => Entreprise::first()?->id ?? Entreprise::create(['nom' => 'MobiliTech'])->id,
            'ville_residence' => 'Paris',
            'role' => 'passager',
            'password' => Hash::make('password'),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
