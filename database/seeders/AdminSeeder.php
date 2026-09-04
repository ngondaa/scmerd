<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'ngondaamn@gmail.com';

        $user = User::firstOrNew(['email' => $email]);
        $user->name = $user->name ?: 'Admin User';
        if (! $user->exists) {
            $user->password = Hash::make(Str::random(12));
            $user->email_verified_at = now();
        }
        $user->is_admin = true;
        $user->save();

        $this->command->info("Admin user ensured: {$email}");
    }
}
