<?php

use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

test('reviewer can download abstracts CSV', function () {
    $reviewer = User::factory()->create(['is_reviewer' => true]);

    \App\Models\Submission::create([
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

    \App\Models\Submission::create([
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

    \App\Models\Submission::create([
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
