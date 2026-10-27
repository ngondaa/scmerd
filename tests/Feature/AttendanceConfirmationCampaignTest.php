<?php

use App\Jobs\SendAttendanceConfirmationCampaign;
use App\Mail\AttendanceConfirmation;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\URL;

it('lets an administrator preview and send the attendance confirmation campaign', function () {
    Queue::fake();
    $admin = User::factory()->create(['is_admin' => true]);
    User::factory()->create();

    $this->actingAs($admin)
        ->get(route('admin.attendance-campaign.preview'))
        ->assertOk()
        ->assertSee('2')
        ->assertSee('user accounts')
        ->assertSee('gala dinner');

    $this->actingAs($admin)
        ->post(route('admin.attendance-campaign.send'))
        ->assertRedirect(route('admin.attendance-campaign.preview'));

    Queue::assertPushed(SendAttendanceConfirmationCampaign::class, 1);
});

it('sends the accepted-author campaign only to authors with accepted abstracts', function () {
    Queue::fake();
    $admin = User::factory()->create(['is_admin' => true]);
    $acceptedAuthor = User::factory()->create();
    $otherAuthor = User::factory()->create();

    Submission::withoutEvents(fn () => Submission::create([
        'user_id' => $acceptedAuthor->id,
        'title' => 'Accepted abstract',
        'author' => $acceptedAuthor->name,
        'track' => 'Abstract Submission',
        'abstract' => 'Test abstract.',
        'status' => 'Accepted',
        'submitted_at' => now(),
    ]));

    $this->actingAs($admin)
        ->get(route('admin.accepted-authors-campaign.preview'))
        ->assertOk()
        ->assertSee('1')
        ->assertSee('accepted abstract');

    $this->actingAs($admin)
        ->post(route('admin.accepted-authors-campaign.send'))
        ->assertRedirect(route('admin.accepted-authors-campaign.preview'));

    Queue::assertPushed(SendAttendanceConfirmationCampaign::class, fn (SendAttendanceConfirmationCampaign $job): bool => $job->acceptedAuthorsOnly);

    expect($otherAuthor->submissions)->toBeEmpty();
});

it('sends attendance reminders only to users who have not confirmed', function () {
    Queue::fake();
    $admin = User::factory()->create(['is_admin' => true]);
    User::factory()->create(['attendance_confirmed_at' => now()]);
    User::factory()->create(['attendance_confirmed_at' => null]);

    $this->actingAs($admin)
        ->get(route('admin.unconfirmed-attendance-campaign.preview'))
        ->assertOk()
        ->assertSee('2')
        ->assertSee('not confirmed conference attendance');

    $this->actingAs($admin)
        ->post(route('admin.unconfirmed-attendance-campaign.send'))
        ->assertRedirect(route('admin.unconfirmed-attendance-campaign.preview'));

    Queue::assertPushed(SendAttendanceConfirmationCampaign::class, fn (SendAttendanceConfirmationCampaign $job): bool => $job->onlyUnconfirmed);
});

it('does not include attendance options in accepted-abstract emails', function () {
    $user = User::factory()->create();

    $mail = new AttendanceConfirmation($user, acceptedAbstractAuthor: true);

    expect($mail->render())
        ->toContain('Your abstract has been accepted')
        ->not->toContain('I am attending the conference');
});

it('records a gala dinner response and confirms conference attendance', function () {
    $user = User::factory()->create();
    $url = URL::temporarySignedRoute(
        'attendance-confirmations.store',
        now()->addDay(),
        ['user' => $user, 'response' => 'gala-dinner'],
    );

    $this->get($url)
        ->assertRedirect(route('home'));

    expect($user->fresh()->attendance_confirmed_at)->not->toBeNull()
        ->and($user->fresh()->gala_dinner_confirmed_at)->not->toBeNull();
});

it('records a conference-only response without confirming gala dinner attendance', function () {
    $user = User::factory()->create();
    $url = URL::temporarySignedRoute(
        'attendance-confirmations.store',
        now()->addDay(),
        ['user' => $user, 'response' => 'attending'],
    );

    $this->get($url)->assertRedirect(route('home'));

    expect($user->fresh()->attendance_confirmed_at)->not->toBeNull()
        ->and($user->fresh()->gala_dinner_confirmed_at)->toBeNull();
});
