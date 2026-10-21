<?php

use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

it('accepts a PDF document submission without abstract text', function () {
    Mail::fake();
    Storage::fake('public');

    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('submit.store'), [
        'title' => 'Document-only abstract',
        'author' => 'Test Author',
        'track' => 'Abstract Submission',
        'attachment' => UploadedFile::fake()->create('abstract.pdf', 1024, 'application/pdf'),
    ]);

    $response->assertRedirect(route('abstracts', absolute: false));

    $submission = Submission::query()->sole();

    expect($submission->abstract)->toBeNull()
        ->and($submission->attachment_name)->toBe('abstract.pdf');

    Storage::disk('public')->assertExists($submission->attachment_path);
});

it('requires a PDF or Word document for abstract submissions', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->from(route('submit'))->post(route('submit.store'), [
        'title' => 'Missing document',
        'author' => 'Test Author',
        'track' => 'Abstract Submission',
    ]);

    $response->assertRedirect(route('submit'))
        ->assertSessionHasErrors('attachment');
});
