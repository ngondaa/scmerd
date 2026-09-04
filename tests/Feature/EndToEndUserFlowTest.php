<?php

use App\Models\Submission;
use App\Models\User;
use App\Models\Review;

test('end-to-end user flow: register -> pay -> submit -> assign reviewer -> review', function () {
    // Register a new user
    $email = 'e2e-user+'.time().'@example.com';

    $response = $this->post(route('register.store'), [
        'name' => 'E2E User',
        'email' => $email,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasNoErrors()->assertRedirect(route('dashboard', absolute: false));
    $this->assertAuthenticated();

    $user = auth()->user();

    // Mark registration as paid
    $user->registration_paid_at = now();
    $user->save();

    // Submit an abstract
    $title = 'E2E Test Submission ' . time();

    $submitResponse = $this->actingAs($user)->post(route('submit.store'), [
        'title' => $title,
        'author' => 'E2E User',
        'track' => 'Abstract Submission',
        'abstract' => 'This is an end-to-end test abstract.',
    ]);

    $submitResponse->assertRedirect(route('abstracts', absolute: false));

    $submission = Submission::where('title', $title)->first();
    $this->assertNotNull($submission, 'Submission was not created');

    // Create a reviewer
    $reviewer = User::factory()->create(['is_reviewer' => true]);

    // Assign reviewer to submission
    $assignResponse = $this->actingAs($reviewer)->post(route('reviewer.submission.assign', $submission), [
        'user_id' => $reviewer->id,
    ]);

    $assignResponse->assertSessionHas('status');

    $this->assertDatabaseHas('submission_reviewer', [
        'submission_id' => $submission->id,
        'user_id' => $reviewer->id,
    ]);

    // Reviewer posts a review
    $commentResponse = $this->actingAs($reviewer)->post(route('reviewer.comment', $submission), [
        'comment' => 'Well written.',
        'status' => 'Accepted',
    ]);

    $commentResponse->assertSessionHas('status');

    $this->assertDatabaseHas('reviews', [
        'submission_id' => $submission->id,
        'user_id' => $reviewer->id,
        'comment' => 'Well written.',
        'status' => 'Accepted',
    ]);

    $this->assertEquals('Accepted', $submission->refresh()->status);
});
