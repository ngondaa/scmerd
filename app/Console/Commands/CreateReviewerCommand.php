<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateReviewerCommand extends Command
{
    protected $signature = 'app:create-reviewer {email} {name} {--password= : Reviewer password}';

    protected $description = 'Create a special reviewer account for abstract review access.';

    public function handle(): int
    {
        $email = $this->argument('email');
        $name = $this->argument('name');
        $password = $this->option('password') ?: 'password';

        $user = User::query()->firstOrNew(['email' => $email]);
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->email_verified_at = now();
        $user->is_reviewer = true;
        $user->save();

        $this->info("Reviewer account created for {$user->email}.");
        $this->line('Password: '.$password);

        return self::SUCCESS;
    }
}
