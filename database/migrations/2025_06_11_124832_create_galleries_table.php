<?php

use App\Models\Branch;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class, 'branch_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('image');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->string('link')->nullable();
            $table->enum('type', ['image', 'video'])->default('image');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};

// php artisan migrate --path=/database/migrations/2025_06_11_124832_create_galleries_table.php
