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
        Schema::table('joiners', function (Blueprint $table) {
            $table->string('comment_image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('joiners', function (Blueprint $table) {
            $table->string('comment_image')->nullable(false)->change();
        });
    }
};
// php artisan migrate --path=/database/migrations/2025_07_16_081846_alter_table_joiners_make_comment_image_nullable.php
