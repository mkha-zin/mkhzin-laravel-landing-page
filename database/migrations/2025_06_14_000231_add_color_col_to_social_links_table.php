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
        Schema::table('social_links', static function (Blueprint $table) {
            $table->string('color')->nullable()->after('link');
            $table->string('key')->nullable()->after('color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_links', static function (Blueprint $table) {
            $table->dropColumn('color');
            $table->dropColumn('key');
        });
    }
};

// php artisan migrate --path=database/migrations/2025_06_14_000231_add_color_col_to_social_links_table.php
