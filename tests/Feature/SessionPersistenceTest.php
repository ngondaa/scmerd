<?php

use Illuminate\Support\Facades\Route;

beforeEach(function () {
    // Ensure routes use the web middleware so sessions are active.
    Route::middleware('web')->get('test-session-set', function () {
        session(['integration_test_key' => 'integration_test_value']);
        return response('ok');
    });

    Route::middleware('web')->get('test-session-get', function () {
        return response()->json(['integration_test_key' => session('integration_test_key')]);
    });
});

it('persists session data when using the database driver', function () {
    config(['session.driver' => 'database']);

    $setResponse = $this->get('test-session-set');

    // Extract the session cookie from the response
    $cookies = $setResponse->headers->getCookies();
    $this->assertNotEmpty($cookies, 'No cookies were set on session set response');

    $sessionCookie = collect($cookies)->first();
    $this->assertNotNull($sessionCookie, 'Session cookie not found');

    // Use the same cookie on the next request to simulate the browser
    $getResponse = $this->withCookie($sessionCookie->getName(), $sessionCookie->getValue())
        ->get('test-session-get');

    $getResponse->assertOk()->assertJsonPath('integration_test_key', 'integration_test_value');
});
