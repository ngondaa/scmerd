<?php

use App\Models\Submission;
use App\Models\User;
use App\Models\Review;
use App\Models\AppSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

test('end-to-end user flow: register -> pay -> submit -> assign reviewer -> review', function () {
    Storage::fake('public');
    Bus::fake();
    AppSetting::set('registration_open', '1');

    // Register a new user
    $email = 'e2e-user+'.time().'@example.com';

    $response = $this->post(route('register.store'), [
        'name' => 'E2E User',
        'email' => $email,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasNoErrors()->assertRedirect(route('verification.notice', absolute: false));
    $this->assertAuthenticated();

    $user = auth()->user();

    // Verify the email before accessing registration and submission routes.
    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)],
    );
    $this->actingAs($user)->get($verificationUrl)
        ->assertRedirect(route('dashboard', absolute: false).'?verified=1');
    $user->refresh();

    // Submit a proof of payment, then approve it as an administrator.
    $this->actingAs($user)->post(route('registration.proof.store'), [
        'package' => 'standard',
        'certificate_name' => 'E2E User',
        'proof' => UploadedFile::fake()->image('payment-proof.png'),
    ])->assertRedirect(route('dashboard'));

    expect($user->fresh()->registration_status)->toBe('pending');

    $admin = User::factory()->create(['is_admin' => true]);
    $this->actingAs($admin)->post(route('admin.users.verify-payment', $user), [
        'action' => 'approve',
    ])->assertSessionHas('status');

    expect($user->fresh()->registration_status)->toBe('paid')
        ->and($user->fresh()->registration_paid_at)->not->toBeNull();

    // Submit an abstract
    $title = 'E2E Test Submission ' . time();

    $submitResponse = $this->actingAs($user->fresh())->post(route('submit.store'), [
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
