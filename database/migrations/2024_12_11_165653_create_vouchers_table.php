<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vouchers', static function (Blueprint $table) {
            $table->id();

            $table->string('voucher')->unique();
            $table->string('c_name')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('used')->default(false);
            $table->timestamp('using_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
