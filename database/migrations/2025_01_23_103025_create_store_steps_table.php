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
        Schema::create('store_steps', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->unique();
            $table->string('title_ar', 20);
            $table->string('title_en', 20);
            $table->string('description_ar', 255);
            $table->string('description_en', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_steps');
    }
};
