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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // registration, payment, verification, etc.
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable(); // Additional data like registration_id, etc.
            $table->timestamp('read_at')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Admin user
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
