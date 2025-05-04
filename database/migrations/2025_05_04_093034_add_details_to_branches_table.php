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
        Schema::table('branches', function (Blueprint $table) {
            $table->longText('description_ar')->nullable()->after('address_en');
            $table->longText('description_en')->nullable()->after('description_ar');
            $table->string('longitude')->nullable()->after('description_en');
            $table->string('latitude')->nullable()->after('longitude');
            $table->string('snapchat')->nullable()->after('latitude');
            $table->string('tiktok')->nullable()->after('snapchat');
            $table->string('instagram')->nullable()->after('tiktok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn([
                'description_ar',
                'description_en',
                'longitude',
                'latitude',
                'snapchat',
                'tiktok',
                'instagram'
            ]);
        });
    }
};
