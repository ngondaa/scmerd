<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

beforeEach(function () {
    Route::middleware('web')->get('test-session-set', function () {
        session(['integration_test_key' => 'integration_test_value']);
        return response('ok');
    });

    Route::middleware('web')->get('test-session-get', function () {
        return response()->json(['integration_test_key' => session('integration_test_key')]);
    });
});

test('session is invalidated on logout', function () {
    config(['session.driver' => 'database']);

    $user = User::factory()->create();

    $this->actingAs($user);

    $setResponse = $this->get('test-session-set');

    $setResponse->assertOk();

    // perform logout which should invalidate the session
    $this->post(route('logout'));

    $getResponse = $this->get('test-session-get');

    $getResponse->assertOk()->assertJsonPath('integration_test_key', null);
});

test('session is invalidated on password change', function () {
    config(['session.driver' => 'database']);

    $user = User::factory()->create(['password' => bcrypt('password')]);

    $this->actingAs($user);

    $setResponse = $this->get('test-session-set');
    $setResponse->assertOk();

    // Use the Livewire component to change password (same as other tests)
    $component = Livewire::test('pages::settings.security')
        ->set('current_password', 'password')
        ->set('password', 'new-password')
        ->set('password_confirmation', 'new-password')
        ->call('updatePassword');

    $component->assertHasNoErrors();

    $getResponse = $this->get('test-session-get');

    $getResponse->assertOk()->assertJsonPath('integration_test_key', null);
});
