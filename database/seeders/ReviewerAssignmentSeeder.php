<?php

namespace Database\Seeders;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewerAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviewers = User::where('is_reviewer', true)->take(5)->get();
        $submission = Submission::first();

        if ($submission && $reviewers->isNotEmpty()) {
            foreach ($reviewers as $r) {
                if (! $submission->reviewers()->where('user_id', $r->id)->exists()) {
                    $submission->reviewers()->attach($r->id, ['assigned_at' => now()]);
                }
            }
        }
    }
}
