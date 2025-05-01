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
            $table->enum('resume_state', ['required', 'optional', 'not_wanted'])->nullable()->after('questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            $table->dropColumn('resume_state');
        });
    }
};

// php artisan migrate --path=database/migrations/2025_05_01_140152_add_resume_state_to_careers_table.php
