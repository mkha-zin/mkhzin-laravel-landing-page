<?php

use App\Models\Branch;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class, 'branch_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('slug')->nullable();
            $table->string('designation_ar')->nullable();
            $table->string('designation_en')->nullable();
            $table->string('image')->nullable();
            $table->json('contacts')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

// php artisan migrate --path=/database/migrations/2025_05_17_084510_create_employees_table.php
