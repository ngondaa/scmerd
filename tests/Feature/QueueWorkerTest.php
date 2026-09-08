<?php

use App\Jobs\ProofAnalysisJob;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;

it('processes ProofAnalysisJob through the database queue worker', function () {
    Storage::fake('public');

    putenv('PROOF_ANALYSIS_FAKE_OCR=R650');
    $_ENV['PROOF_ANALYSIS_FAKE_OCR'] = 'R650';

    $user = User::factory()->create([
        'registration_package' => 'standard',
        'registration_status' => 'pending',
        'payment_proof_path' => 'payment_proofs/queue-proof.png',
        'payment_proof_analysis' => 'queued',
    ]);

    Storage::disk('public')->put('payment_proofs/queue-proof.png', 'FAKE_OCR:R650');

    expect(config('queue.default'))->toBe('database');

    ProofAnalysisJob::dispatch($user->id);

    expect(DB::table('jobs')->count())->toBeGreaterThan(0);

    $exitCode = Artisan::call('queue:work', [
        '--once' => true,
        '--tries' => 1,
        '--stop-when-empty' => true,
    ]);

    expect($exitCode)->toBe(0)
        ->and(DB::table('jobs')->count())->toBe(0)
        ->and($user->fresh()->registration_status)->toBe('paid')
        ->and($user->fresh()->registration_paid_at)->not->toBeNull()
        ->and($user->fresh()->payment_proof_analysis)->not->toBe('queued');
});
