<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action'); // created, verified, cancelled, refunded, etc.
            $table->string('model_type'); // Registration, PaymentProof, etc.
            $table->unsignedBigInteger('model_id');
            $table->string('user_id')->nullable(); // User yang melakukan aksi
            $table->string('user_name')->nullable();
            $table->text('changes')->nullable(); // JSON dengan perubahan
            $table->text('notes')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
            
            $table->index(['model_type', 'model_id']);
            $table->index('action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
