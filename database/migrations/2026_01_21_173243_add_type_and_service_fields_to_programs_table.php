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
            $table->enum('type', ['service', 'program'])->default('program')->after('id');
            $table->string('code')->nullable()->after('name');
            $table->json('education_levels')->nullable()->after('education_level');
            $table->boolean('for_parent_register')->default(true)->after('education_levels');
            $table->boolean('for_self_register')->default(true)->after('for_parent_register');
            $table->integer('min_age')->nullable()->after('for_self_register');
            $table->integer('max_age')->nullable()->after('min_age');
            $table->text('features')->nullable()->after('max_age');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['type', 'code', 'education_levels', 'for_parent_register', 'for_self_register', 'min_age', 'max_age', 'features']);
        });
    }
};
