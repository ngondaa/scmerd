<?php

use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

it('accepts and stores multiple document submissions without abstract text', function () {
    Mail::fake();
    Storage::fake('public');

    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('submit.store'), [
        'title' => 'Document-only abstract',
        'author' => 'Test Author',
        'track' => 'Abstract Submission',
        'attachments' => [
            UploadedFile::fake()->create('abstract.pdf', 1024, 'application/pdf'),
            UploadedFile::fake()->create('supporting-document.docx', 1024, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
        ],
    ]);

    $response->assertRedirect(route('abstracts', absolute: false));

    $submission = Submission::query()->sole();

    expect($submission->abstract)->toBeNull()
        ->and($submission->attachment_name)->toBe('abstract.pdf')
        ->and($submission->attachments)->toHaveCount(2);

    Storage::disk('public')->assertExists($submission->attachment_path);
    Storage::disk('public')->assertExists($submission->attachments[1]->path);

    $this->actingAs($user)
        ->get(route('downloads.additional-attachment', [
            'submission' => $submission,
            'attachment' => $submission->attachments[1],
        ]))
        ->assertDownload('supporting-document.docx');
});

it('requires a PDF or Word document for abstract submissions', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->from(route('submit'))->post(route('submit.store'), [
        'title' => 'Missing document',
        'author' => 'Test Author',
        'track' => 'Abstract Submission',
    ]);

    $response->assertRedirect(route('submit'))
        ->assertSessionHasErrors('attachments');
});
