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
        Schema::table('jobs_settings', function (Blueprint $table) {
            $table->string('first_bnr_img')->nullable()->after('general_description_en');
            $table->string('second_bnr_img')->nullable()->after('first_bnr_img');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs_settings', function (Blueprint $table) {
            $table->dropColumn(['first_bnr_img', 'second_bnr_img']);
        });
    }
};

// php artisan migrate --path=database/migrations/2025_04_29_111843_add_banner_images_to_jobs_settings_table.php
