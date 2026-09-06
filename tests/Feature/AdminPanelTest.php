<?php

use App\Models\User;

test('admin panel bootstraps without crashing', function () {
    $response = $this->get('/admin');

    $response->assertRedirect('/admin/login');
});

test('an admin can access the legacy payment-review page', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $this->actingAs($admin)
        ->get(route('admin.settings'))
        ->assertOk();
});
