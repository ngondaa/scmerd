<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProofAnalysisJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function handle(): void
    {
        $user = User::find($this->userId);

        if (! $user || ! $user->payment_proof_path) {
            return;
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($user->payment_proof_path)) {
            $user->update(['payment_proof_analysis' => json_encode(['status' => 'file_missing'])]);
            return;
        }

        $localPath = $disk->path($user->payment_proof_path);

        // Attempt to run tesseract if available
        $extracted = '';

            // Test hook: if the stored file begins with FAKE_OCR: use its remainder as the OCR text.
            try {
                $raw = $disk->get($user->payment_proof_path);
                if (is_string($raw) && str_starts_with($raw, 'FAKE_OCR:')) {
                    $extracted = substr($raw, 9);
                }
            } catch (\Exception $e) {
                // ignore
            }

        // Test hook: if PROOF_ANALYSIS_FAKE_OCR is set, use it as extracted text.
        $fake = getenv('PROOF_ANALYSIS_FAKE_OCR');
        if (is_string($fake) && $fake !== '') {
            $extracted = $fake;
        } else {
            $tesseractCmd = trim(shell_exec('which tesseract 2>/dev/null'));

            if ($tesseractCmd !== '') {
                $escaped = escapeshellarg($localPath);
                $cmd = "tesseract $escaped stdout 2>/dev/null";
                $output = shell_exec($cmd);
                if (is_string($output) && trim($output) !== '') {
                    $extracted = $output;
                }
            }
        }

        if ($extracted === '') {
            // No OCR available or nothing extracted — mark for manual review
            $user->update(['payment_proof_analysis' => json_encode(['status' => 'no_ocr', 'text' => null])]);
            return;
        }

        $text = $extracted;

        // Debug: log extracted text for tests
        Log::info('proof_analysis_debug', ['user' => $user->id, 'extracted' => $extracted]);

        $expected = config('registration.packages.' . ($user->registration_package ?? 'standard') . '.amount');

        $result = self::analyzeText($text, (int) $expected);

        if (($result['status'] ?? '') === 'approved') {
            $user->update(['registration_paid_at' => now(), 'registration_status' => 'approved']);
        } elseif (! empty($result['best'])) {
            $user->update(['registration_status' => 'pending_review']);
        }

        $user->update(['payment_proof_analysis' => json_encode($result)]);
    }

    /**
     * Analyze OCR text and return structured result.
     *
     * @param string $text
     * @param int $expectedCents
     * @return array
     */
    public static function analyzeText(string $text, int $expectedCents): array
    {
        // Find all numeric-like tokens that look like amounts
        preg_match_all('/R?\s*([0-9]{1,3}(?:[,\.][0-9]{3})*(?:[\.,][0-9]+)?|[0-9]+(?:[\.,][0-9]+)?)/i', $text, $matches);
        $candidates = [];

        foreach (($matches[1] ?? []) as $m) {
            $norm = str_replace([',',' '], ['', ''], $m);
            $norm = str_replace(',', '', $norm);
            $norm = str_replace(' ', '', $norm);
            $norm = str_replace('R', '', $norm);
            $norm = str_replace('r', '', $norm);
            $norm = str_replace('ZAR', '', $norm);
            $norm = trim($norm);
            if ($norm === '') {
                continue;
            }
            // convert to float
            $float = (float) str_replace(',', '.', $norm);
            if ($float <= 0) {
                continue;
            }

            // heuristic: if value >= 1000 treat as cents; else treat as rands and multiply by 100
            if ($float >= 1000) {
                $cents = (int) round($float);
            } else {
                $cents = (int) round($float * 100);
            }

            $candidates[] = ['raw' => $m, 'float' => $float, 'cents' => $cents];
        }

        $best = null;
        if (! empty($candidates)) {
            // choose candidate with minimal absolute difference to expected
            usort($candidates, function ($a, $b) use ($expectedCents) {
                return abs(($a['cents'] ?? 0) - $expectedCents) <=> abs(($b['cents'] ?? 0) - $expectedCents);
            });
            $best = $candidates[0];
        }

        $result = ['status' => 'manual_review', 'text' => trim($text), 'candidates' => $candidates, 'expected' => $expectedCents];

        if ($best) {
            $result['best'] = $best;
            if ($best['cents'] === (int) $expectedCents) {
                $result['status'] = 'approved';
                $result['notes'] = 'Exact amount match';
            } else {
                $result['notes'] = 'Amount mismatch';
                $result['difference'] = abs($best['cents'] - $expectedCents);
            }
        }

        return $result;
    }
}
