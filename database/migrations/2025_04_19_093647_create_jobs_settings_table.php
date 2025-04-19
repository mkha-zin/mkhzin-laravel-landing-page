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
        Schema::create('jobs_settings', function (Blueprint $table) {
            $table->id();
            $table->string('home_title_ar');
            $table->string('home_title_en');
            $table->longText('home_description_ar');
            $table->longText('home_description_en');
            $table->string('general_title_ar');
            $table->string('general_title_en');
            $table->longText('general_description_ar');
            $table->longText('general_description_en');
            $table->timestamps();
        });

        // Insert default data
        DB::table('jobs_settings')->insert([
            'home_title_ar' => 'مرحبا',
            'home_title_en' => 'Hello',
            'home_description_ar' => 'مرحبا بكم في تطبيق الوظائف',
            'home_description_en' => 'Welcome to Job application',
            'general_title_ar' => 'التطبيق',
            'general_title_en' => 'Application',
            'general_description_ar' => 'تطبيق الوظائف',
            'general_description_en' => 'Job application',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs_settings');
    }
};
