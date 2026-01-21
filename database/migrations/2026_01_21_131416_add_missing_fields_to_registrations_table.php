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
            $table->string('student_identity_number')->nullable()->after('student_name');
            $table->string('student_job')->nullable()->after('student_email');
            $table->integer('student_age')->nullable()->after('student_dob');
            $table->string('parent_identity_number')->nullable()->after('parent_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['student_identity_number', 'student_job', 'student_age', 'parent_identity_number']);
        });
    }
};
