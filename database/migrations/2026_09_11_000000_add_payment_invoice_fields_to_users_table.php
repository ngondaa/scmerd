<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('payment_invoice_number')->nullable()->after('payment_proof_path');
            $table->string('payment_proof_original_name')->nullable()->after('payment_proof_path');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['payment_invoice_number', 'payment_proof_original_name']);
        });
    }
};
