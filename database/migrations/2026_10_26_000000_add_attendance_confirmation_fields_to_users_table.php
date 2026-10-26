<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->timestamp('attendance_confirmed_at')->nullable()->after('registration_paid_at');
            $table->timestamp('presenting_confirmed_at')->nullable()->after('attendance_confirmed_at');
            $table->timestamp('gala_dinner_confirmed_at')->nullable()->after('presenting_confirmed_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn([
                'attendance_confirmed_at',
                'presenting_confirmed_at',
                'gala_dinner_confirmed_at',
            ]);
        });
    }
};
