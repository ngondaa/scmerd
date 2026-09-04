<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('registration_package')->nullable();
            $table->string('certificate_name')->nullable();
            $table->boolean('ecsa_accredited')->default(false);
            $table->string('ecsa_number')->nullable();
            $table->string('student_id')->nullable();
            $table->string('stripe_checkout_session_id')->nullable();
            $table->timestamp('registration_paid_at')->nullable();
            $table->string('payment_proof_path')->nullable();
            $table->text('payment_proof_analysis')->nullable();
            $table->string('registration_status')->default('unpaid');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'registration_package',
                'certificate_name',
                'ecsa_accredited',
                'ecsa_number',
                'student_id',
                'stripe_checkout_session_id',
                'registration_paid_at',
            ]);
        });
    }
};
