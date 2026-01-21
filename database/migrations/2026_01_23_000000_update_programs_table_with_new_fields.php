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
        Schema::table('programs', function (Blueprint $table) {
            // Add new fields for comprehensive program management
            $table->enum('media', ['online', 'offline'])->after('service_id')->default('offline');
            $table->string('class_location')->after('media')->nullable(); // Rumah siswa, Kelas Sibali, Rumah siswa (≥2)
            $table->integer('sessions_count')->after('class_location')->default(8); // Jumlah Pertemuan
            $table->decimal('hpp', 12, 2)->after('sessions_count')->default(0); // Cost price
            $table->string('unit')->after('price')->default('1 Bulan'); // Satuan: 1 Bulan, 1 Pertemuan, etc.
            $table->string('min_education_level')->after('unit')->nullable(); // Min. Tingkat Pendidikan
            $table->string('max_education_level')->after('min_education_level')->nullable(); // Maks. Tingkat Pendidikan
            
            // Rename duration_weeks to duration for more flexibility
            $table->renameColumn('duration_weeks', 'duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn([
                'media',
                'class_location',
                'sessions_count',
                'hpp',
                'unit',
                'min_education_level',
                'max_education_level',
            ]);
            
            $table->renameColumn('duration', 'duration_weeks');
        });
    }
};
