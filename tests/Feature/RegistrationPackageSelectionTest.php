<?php

use App\Models\User;

test('selecting a registration package persists it and opens its payment form', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('update-package'), [
        'package' => 'full_non_member',
    ]);

    $response->assertRedirect(route('registration.proof', ['package' => 'full_non_member']));
    expect($user->fresh()->registration_package)->toBe('full_non_member');

    $this->actingAs($user)
        ->get(route('registration.proof', ['package' => 'full_non_member']))
        ->assertOk()
        ->assertSee('Full Conference — Non-SAIMechE Member')
        ->assertSee('R1 850');
});

test('the dashboard shows the saved package as selected', function () {
    $user = User::factory()->create([
        'registration_package' => 'student_member_conference_gala',
    ]);

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertSee('id="pkg-student_member_conference_gala" name="package" value="student_member_conference_gala" required checked', false);
});
