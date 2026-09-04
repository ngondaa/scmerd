<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // insert default registration mode if not present
        $exists = DB::table('app_settings')->where('key', 'registration_mode')->exists();
        if (! $exists) {
            DB::table('app_settings')->insert([
                'key' => 'registration_mode',
                'value' => 'manual',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('app_settings')->where('key', 'registration_mode')->delete();
    }
};
