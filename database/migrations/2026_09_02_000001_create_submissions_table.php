<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('author');
            $table->string('track');
            $table->string('stage')->default('Abstract Submission');
            $table->text('keywords')->nullable();
            $table->longText('abstract');
            $table->string('status')->default('Under Initial Review');
            $table->timestamp('submitted_at')->nullable();
            $table->string('attachment_path')->nullable();
            $table->string('attachment_name')->nullable();
            $table->json('comments')->nullable();
            $table->text('rebuttal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
