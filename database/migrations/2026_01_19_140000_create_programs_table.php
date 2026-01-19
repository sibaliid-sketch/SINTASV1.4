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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ECLAIR, English Champion, English Regular, dll
            $table->text('description')->nullable();
            $table->string('education_level'); // TK, SD, SMP, SMA, Mahasiswa, Umum
            $table->string('service_type'); // Regular-in Class, Private, Rumah Belajar, Mitra Belajar
            $table->integer('duration_weeks'); // durasi program dalam minggu
            $table->decimal('price', 12, 2);
            $table->text('curriculum')->nullable();
            $table->integer('max_students')->default(10);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
