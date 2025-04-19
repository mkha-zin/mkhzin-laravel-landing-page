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
        Schema::table('careers', function (Blueprint $table) {
            // Drop old language-specific columns
            $table->dropColumn(['title_ar', 'title_en', 'description_ar', 'description_en', 'email', 'image']);

            // Add new columns
            $table->string('title')->after('id');
            $table->text('description')->after('title');
            $table->enum('type', ['remote', 'on-site'])->after('description');
            $table->unsignedInteger('applicants')->default(0)->after('type');
            $table->json('questions')->nullable()->after('applicants');
            $table->boolean('is_active')->default(1)->after('questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn(['title', 'description', 'type', 'applicants', 'questions', 'is_active']);

            // Restore old columns
            $table->string('title_ar');
            $table->string('title_en');
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->string('email');
            $table->string('image');
        });
    }
};
