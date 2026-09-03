<?php

test('static site registration endpoint accepts public registrations', function () {
    $response = $this->postJson('/api/site/register', [
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'university' => 'University of Johannesburg',
        'discipline' => 'Mechanical Engineering',
        'package' => 'standard',
        'certificate_name' => 'Jane Doe',
        'ecsa_accredited' => true,
        'ecsa_number' => 'ECSA-12345',
        'student_id' => 'STU-789',
    ]);

    $response->assertOk()
        ->assertJsonPath('status', 'success')
        ->assertJsonPath('data.email', 'jane@example.com');
});

test('static site submission endpoint accepts abstract submissions', function () {
    $response = $this->postJson('/api/site/submit', [
        'presenter' => 'Jane Doe',
        'affiliation' => 'University of Johannesburg',
        'title' => 'Smart machining optimisation',
        'track' => 'Mechanical Engineering',
        'abstract' => 'This paper investigates a smart machining optimisation system for manufacturing efficiency.',
    ]);

    $response->assertOk()
        ->assertJsonPath('status', 'success')
        ->assertJsonPath('data.title', 'Smart machining optimisation');
});
