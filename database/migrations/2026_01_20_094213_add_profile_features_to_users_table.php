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
        Schema::table('users', function (Blueprint $table) {
            // Google OAuth
            $table->string('google_id')->nullable()->unique();
            $table->string('google_token')->nullable();
            $table->string('google_refresh_token')->nullable();

            // Profile
            $table->string('avatar')->nullable();
            $table->string('bio')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();

            // Preferences
            $table->string('theme')->default('light'); // light, dark, auto
            $table->string('language')->default('id');
            $table->json('notification_settings')->nullable();

            // Social Links
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('website_url')->nullable();

            // Security
            $table->boolean('two_factor_enabled')->default(false);
            $table->string('two_factor_secret')->nullable();
            $table->json('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();

            // Statistics
            $table->integer('login_count')->default(0);
            $table->timestamp('last_login_at')->nullable();
            $table->json('login_devices')->nullable();

            // Privacy
            $table->boolean('profile_visible')->default(true);
            $table->boolean('show_email')->default(false);
            $table->boolean('show_activity')->default(true);

            // Referral
            $table->string('referral_code')->nullable()->unique();
            $table->unsignedBigInteger('referred_by')->nullable();
            $table->foreign('referred_by')->references('id')->on('users');

            // Achievements
            $table->json('achievements')->nullable();
            $table->integer('points')->default(0);

            // Bookmarks
            $table->json('bookmarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['referred_by']);
            $table->dropColumn([
                'google_id', 'google_token', 'google_refresh_token',
                'avatar', 'bio', 'date_of_birth', 'phone', 'address', 'city', 'country',
                'theme', 'language', 'notification_settings',
                'linkedin_url', 'twitter_url', 'github_url', 'website_url',
                'two_factor_enabled', 'two_factor_secret', 'two_factor_recovery_codes', 'two_factor_confirmed_at',
                'login_count', 'last_login_at', 'login_devices',
                'profile_visible', 'show_email', 'show_activity',
                'referral_code', 'referred_by',
                'achievements', 'points',
                'bookmarks'
            ]);
        });
    }
};
