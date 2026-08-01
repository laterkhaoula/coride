<?php

use App\Models\Employe;
use App\Models\Entreprise;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $entreprise = Entreprise::firstOrCreate(['nom' => 'MobiliTech']);
    $user = Employe::factory()->create(['entreprise_id' => $entreprise->id]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $entreprise = Entreprise::firstOrCreate(['nom' => 'MobiliTech']);
    $user = Employe::factory()->create(['entreprise_id' => $entreprise->id]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $entreprise = Entreprise::firstOrCreate(['nom' => 'MobiliTech']);
    $user = Employe::factory()->create(['entreprise_id' => $entreprise->id]);

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});
