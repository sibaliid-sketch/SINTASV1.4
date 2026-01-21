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
            // Add service_id foreign key
            $table->foreignId('service_id')->nullable()->after('id')->constrained('services')->onDelete('cascade');
            
            // Add class_mode field
            $table->enum('class_mode', ['online', 'offline'])->after('education_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn(['service_id', 'class_mode']);
        });
    }
};
