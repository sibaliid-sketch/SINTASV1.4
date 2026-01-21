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
        Schema::dropIfExists('attendances');
        
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->dateTime('check_in')->nullable();
            $table->dateTime('check_out')->nullable();
            $table->enum('status', ['present', 'late', 'absent', 'leave', 'sick', 'permission'])->default('present');
            $table->text('notes')->nullable();
            $table->string('location')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
            
            // Unique constraint: one attendance record per user per day
            $table->unique(['user_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
        
        // Restore old structure
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('pin');
            $table->string('device_id');
            $table->dateTime('date_time');
            $table->json('raw_payload')->nullable();
            $table->timestamps();
        });
    }
};
