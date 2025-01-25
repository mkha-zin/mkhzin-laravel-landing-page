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
        Schema::create('store_texts', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('description_ar');
            $table->string('description_en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_texts');
    }
};

// php artisan migrate --path=/database/migrations/2025_01_19_104411_create_features_table.php
// php artisan migrate --path=/database/migrations/2025_01_22_152848_create_categories_table.php
// php artisan migrate --path=/database/migrations/2025_01_22_163024_create_store_texts_table.php
