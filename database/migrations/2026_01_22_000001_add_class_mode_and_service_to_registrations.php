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
        Schema::table('registrations', function (Blueprint $table) {
            // Add class_mode field (online/offline)
            $table->enum('class_mode', ['online', 'offline'])->after('class_level');
            
            // Add service_id field (separate from program)
            // Service = Layanan (Regular-in Class, Private, Rumah Belajar, Mitra Belajar)
            // Program = Program specific (ECLAIR, English Champion, etc.)
            $table->foreignId('service_id')->nullable()->after('program_id')->constrained('services')->onDelete('cascade');
            
            // Add structured address fields for student
            $table->string('student_province')->nullable()->after('student_address');
            $table->string('student_regency')->nullable()->after('student_province');
            $table->string('student_district')->nullable()->after('student_regency');
            $table->string('student_village')->nullable()->after('student_district');
            $table->text('student_address_detail')->nullable()->after('student_village');
            
            // Add structured address fields for parent
            $table->string('parent_province')->nullable()->after('parent_address');
            $table->string('parent_regency')->nullable()->after('parent_province');
            $table->string('parent_district')->nullable()->after('parent_regency');
            $table->string('parent_village')->nullable()->after('parent_district');
            $table->text('parent_address_detail')->nullable()->after('parent_village');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'class_mode',
                'service_id',
                'student_province',
                'student_regency',
                'student_district',
                'student_village',
                'student_address_detail',
                'parent_province',
                'parent_regency',
                'parent_district',
                'parent_village',
                'parent_address_detail',
            ]);
        });
    }
};
