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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Regular-in Class, Private, Rumah Belajar, Mitra Belajar
            $table->string('code')->unique(); // RIC, PVT, RBL, MBL
            $table->text('description')->nullable();
            $table->enum('class_mode', ['online', 'offline', 'both']); // Availability mode
            $table->json('education_levels')->nullable(); // ['TK', 'SD', 'SMP', 'SMA', 'Mahasiswa', 'Umum']
            $table->boolean('for_parent_register')->default(true); // Can parent register?
            $table->boolean('for_self_register')->default(true); // Can student register self?
            $table->integer('min_age')->nullable(); // Minimum age requirement
            $table->integer('max_age')->nullable(); // Maximum age requirement
            $table->text('features')->nullable(); // Service features/benefits
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
