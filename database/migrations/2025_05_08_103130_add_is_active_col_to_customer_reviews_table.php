<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update ENUM to include 'website'
        DB::statement("ALTER TABLE customer_reviews MODIFY platform ENUM(
            'google maps',
            'google play',
            'facebook',
            'twitter',
            'instagram',
            'snapchat',
            'tiktok',
            'whatsapp',
            'telegram',
            'linkedin',
            'youtube',
            'website'
        )");

        // Add is_active column
        Schema::table('customer_reviews', function (Blueprint $table) {
            $table->boolean('is_active')->default(false)->after('review');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'website' from ENUM (optional)
        DB::statement("ALTER TABLE customer_reviews MODIFY platform ENUM(
            'google maps',
            'google play',
            'facebook',
            'twitter',
            'instagram',
            'snapchat',
            'tiktok',
            'whatsapp',
            'telegram',
            'linkedin',
            'youtube'
        )");

        // Drop is_active column
        Schema::table('customer_reviews', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};

// php artisan migrate --path=/database/migrations/2025_05_08_103130_add_is_active_col_to_customer_reviews_table.php
