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
        Schema::create('customer_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class, 'branch_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('name');
            $table->enum(
                'platform',
                [
                    'google maps',
                    'google play',
                    'facebook',
                    'twitter',
                    'instagram',
                    'snapchat',
                    'tiktok',
                    'whatsapp',
                    'telegram',
                    'linkedin',
                    'youtube'
                ]);
            $table->string('link')->nullable();
            $table->string('stars');
            $table->longText('review');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_reviews');
    }
};

// php artisan migrate --path=/database/migrations/2025_05_05_103129_create_customer_reviews_table.php
