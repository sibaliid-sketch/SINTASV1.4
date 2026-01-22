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
        Schema::create('class_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->foreignId('schedule_id')->nullable()->constrained('schedules')->onDelete('set null');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('parent_message_id')->nullable()->constrained('class_messages')->onDelete('cascade');
            $table->text('message');
            $table->enum('type', ['text', 'file', 'question', 'answer'])->default('text');
            $table->string('file_url')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->softDeletes();
            $table->timestamps();
            
            $table->index('program_id');
            $table->index('sender_id');
            $table->index('parent_message_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_messages');
    }
};
