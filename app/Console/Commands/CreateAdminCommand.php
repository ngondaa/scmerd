<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    protected $signature = 'app:create-admin {email} {name} {--password= : Admin password}';

    protected $description = 'Create or update an admin user for the Filament admin panel.';

    public function handle(): int
    {
        $email = $this->argument('email');
        $name = $this->argument('name');
        $password = $this->option('password') ?: 'password';

        $user = User::query()->firstOrNew(['email' => $email]);
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->email_verified_at = now();
        $user->is_admin = true;
        $user->save();

        $this->info("Admin account ready for {$user->email}.");
        $this->line('Password: '.$password);
        $this->line('Admin login URL: '.url('/admin/login'));

        return self::SUCCESS;
    }
}
