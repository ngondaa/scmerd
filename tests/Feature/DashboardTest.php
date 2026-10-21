<?php

use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertOk();
});

test('members can access abstract features before paying registration', function () {
    $user = User::factory()->create([
        'registration_paid_at' => null,
    ]);
    $this->actingAs($user);

    $response = $this->get(route('submit'));

    $response->assertOk();

    $this->get(route('abstracts'))->assertOk();
});
