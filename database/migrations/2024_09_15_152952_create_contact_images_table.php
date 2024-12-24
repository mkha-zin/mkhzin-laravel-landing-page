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
        Schema::create('contact_images', static function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('slug')->unique();
            $table->string('view_title_ar')->unique();
            $table->string('view_title_en')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_images');
    }
};
