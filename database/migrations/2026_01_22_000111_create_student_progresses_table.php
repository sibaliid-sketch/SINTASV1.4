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
        Schema::create('student_progresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->foreignId('registration_id')->nullable()->constrained('registrations')->onDelete('set null');
            
            // Material tracking
            $table->integer('total_materials')->default(0);
            $table->integer('completed_materials')->default(0);
            
            // Assignment tracking
            $table->integer('total_assignments')->default(0);
            $table->integer('completed_assignments')->default(0);
            $table->decimal('average_assignment_score', 5, 2)->nullable();
            
            // Quiz tracking
            $table->integer('total_quizzes')->default(0);
            $table->integer('completed_quizzes')->default(0);
            $table->decimal('average_quiz_score', 5, 2)->nullable();
            
            // Overall progress
            $table->decimal('overall_progress_percentage', 5, 2)->default(0);
            $table->enum('status', ['not_started', 'on_track', 'ahead', 'behind', 'completed'])->default('not_started');
            
            $table->dateTime('started_at')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
            
            $table->unique(['student_id', 'program_id']);
            $table->index('student_id');
            $table->index('program_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_progresses');
    }
};
