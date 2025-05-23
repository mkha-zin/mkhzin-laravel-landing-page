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
        Schema::table('offers', static function (Blueprint $table) {
            $table->longText('description_ar')->change();
            $table->longText('description_en')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', static function (Blueprint $table) {
            $table->string('description_ar')->change();
            $table->string('description_en')->change();
        });
    }
};
