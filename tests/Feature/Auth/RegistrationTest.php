<?php

use App\Models\Entreprise;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $entreprise = Entreprise::firstOrCreate(['nom' => 'MobiliTech']);

    $response = $this->post('/register', [
        'nom' => 'Test User',
        'email' => 'test@mobilitech.com',
        'entreprise_id' => $entreprise->id,
        'ville_residence' => 'Paris',
        'role' => 'passager',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});
