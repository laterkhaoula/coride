<?php

use App\Models\Employe;
use App\Models\Entreprise;

test('confirm password screen can be rendered', function () {
    $entreprise = Entreprise::firstOrCreate(['nom' => 'MobiliTech']);
    $user = Employe::factory()->create([
        'entreprise_id' => $entreprise->id,
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($user)->get('/confirm-password');

    $response->assertStatus(200);
});

test('password can be confirmed', function () {
    $entreprise = Entreprise::firstOrCreate(['nom' => 'MobiliTech']);
    $user = Employe::factory()->create([
        'entreprise_id' => $entreprise->id,
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($user)->post('/confirm-password', [
        'password' => 'password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    $entreprise = Entreprise::firstOrCreate(['nom' => 'MobiliTech']);
    $user = Employe::factory()->create([
        'entreprise_id' => $entreprise->id,
        'password' => bcrypt('password'),
    ]);

    $response = $this->actingAs($user)->post('/confirm-password', [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
});
