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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('promo_code')->unique(); // Kode promo
            $table->text('description')->nullable();
            $table->enum('discount_type', ['percentage', 'fixed']); // Persentase atau nominal
            $table->decimal('discount_value', 12, 2);
            $table->integer('max_usage')->nullable(); // Kuota penggunaan
            $table->integer('used_count')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('created_by'); // BD person
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
