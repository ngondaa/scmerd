<?php

use App\Models\User;

it('allows reviewer users to access the reviewer dashboard', function () {
    $user = User::factory()->create([
        'is_reviewer' => true,
    ]);

    $this->actingAs($user);

    $response = $this->get(route('reviewer.dashboard'));

    $response->assertOk();
});

it('creates a reviewer account from the artisan command', function () {
    $this->artisan('app:create-reviewer', [
        'email' => 'reviewer@example.com',
        'name' => 'Reviewer One',
        '--password' => 'secret123',
    ])->assertSuccessful();

    $user = User::query()->where('email', 'reviewer@example.com')->first();

    expect($user)->not->toBeNull()
        ->and($user->is_reviewer)->toBeTrue();
});
