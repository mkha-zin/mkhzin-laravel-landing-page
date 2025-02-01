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
        Schema::table('social_links', static function (Blueprint $table) {
            $table->string('comment_en')->nullable();
            $table->string('comment_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_links', static function (Blueprint $table) {
            $table->dropColumn('comment_en');
            $table->dropColumn('comment_ar');
        });
    }
};
