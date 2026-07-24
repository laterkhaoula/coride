<?php

use App\Models\Employe;
use App\Models\Entreprise;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

test('email verification screen can be rendered', function () {
    $entreprise = Entreprise::firstOrCreate(['nom' => 'MobiliTech']);
    $user = Employe::factory()->unverified()->create(['entreprise_id' => $entreprise->id]);

    $response = $this->actingAs($user)->get('/verify-email');

    $response->assertStatus(200);
});

test('email can be verified', function () {
    $entreprise = Entreprise::firstOrCreate(['nom' => 'MobiliTech']);
    $user = Employe::factory()->unverified()->create(['entreprise_id' => $entreprise->id]);

    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );

    $response = $this->actingAs($user)->get($verificationUrl);

    Event::assertDispatched(Verified::class);
    $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
});

test('email is not verified with invalid hash', function () {
    $entreprise = Entreprise::firstOrCreate(['nom' => 'MobiliTech']);
    $user = Employe::factory()->unverified()->create(['entreprise_id' => $entreprise->id]);

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($user)->get($verificationUrl);

    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});
