<?php

use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

test('reviewer can download abstracts CSV', function () {
    $reviewer = User::factory()->create(['is_reviewer' => true]);

    Submission::create([
        'user_id' => null,
        'title' => 'CSV Test',
        'author' => 'Author',
        'track' => 'Abstract Submission',
        'stage' => 'Abstract Submission',
        'keywords' => null,
        'abstract' => 'Test abstract',
        'status' => 'Under Initial Review',
        'submitted_at' => now(),
    ]);

    $response = $this->actingAs($reviewer)->get(route('reviewer.exports.abstracts'));

    $response->assertStatus(200);
    $this->assertStringContainsString('text/csv', $response->headers->get('Content-Type'));
});

test('reviewer can download attachments zip', function () {
    $reviewer = User::factory()->create(['is_reviewer' => true]);

    // create fake files
    Storage::disk('public')->put('submissions/file1.pdf', 'contents1');
    Storage::disk('public')->put('submissions/file2.pdf', 'contents2');

    Submission::create([
        'user_id' => null,
        'title' => 'File1',
        'author' => 'Author1',
        'track' => 'Abstract Submission',
        'stage' => 'Abstract Submission',
        'keywords' => null,
        'abstract' => 'A',
        'status' => 'Under Initial Review',
        'submitted_at' => now(),
        'attachment_path' => 'submissions/file1.pdf',
    ]);

    Submission::create([
        'user_id' => null,
        'title' => 'File2',
        'author' => 'Author2',
        'track' => 'Abstract Submission',
        'stage' => 'Abstract Submission',
        'keywords' => null,
        'abstract' => 'B',
        'status' => 'Under Initial Review',
        'submitted_at' => now(),
        'attachment_path' => 'submissions/file2.pdf',
    ]);

    $response = $this->actingAs($reviewer)->get(route('reviewer.exports.attachments'));

    $response->assertStatus(200);
    $this->assertTrue(in_array($response->headers->get('Content-Type'), ['application/zip', 'application/octet-stream']));
});

test('reviewer can download an attachment belonging to another author', function () {
    $reviewer = User::factory()->create(['is_reviewer' => true]);
    $author = User::factory()->create();

    Storage::disk('public')->put('submissions/reviewer-download.pdf', 'contents');

    $submission = Submission::create([
        'user_id' => $author->id,
        'title' => 'Reviewer download',
        'author' => 'Author',
        'track' => 'Abstract Submission',
        'stage' => 'Abstract Submission',
        'abstract' => 'Test abstract',
        'status' => 'Under Initial Review',
        'submitted_at' => now(),
        'attachment_path' => 'submissions/reviewer-download.pdf',
        'attachment_name' => 'reviewer-download.pdf',
    ]);

    $response = $this->actingAs($reviewer)->get(route('downloads.attachment', $submission));

    $response->assertOk();
    $response->assertDownload('reviewer-download.pdf');
});

test('admin can export only accepted abstracts as a PDF', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    Submission::withoutEvents(function (): void {
        Submission::create([
            'title' => 'Accepted abstract',
            'author' => 'Accepted Author',
            'track' => 'Thermal Engineering',
            'abstract' => 'Accepted abstract content.',
            'status' => 'Accepted',
            'submitted_at' => now(),
        ]);
        Submission::create([
            'title' => 'Rejected abstract',
            'author' => 'Rejected Author',
            'track' => 'Manufacturing',
            'abstract' => 'Rejected abstract content.',
            'status' => 'Rejected',
            'submitted_at' => now(),
        ]);
    });

    $response = $this->actingAs($admin)->get(route('admin.exports.accepted-abstracts'));

    $response->assertOk()
        ->assertDownload('accepted-abstracts-'.now()->format('Y-m-d').'.pdf');
    expect($response->headers->get('Content-Type'))->toContain('application/pdf')
        ->and($response->getContent())->toStartWith('%PDF-')
        ->and(Submission::query()->where('status', 'Accepted')->pluck('title')->all())
        ->toBe(['Accepted abstract']);
});
