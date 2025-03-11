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
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['tag_ar', 'tag_en']);
            $table->foreignId('tag_id')->nullable()->constrained('tags')->onDelete('cascade');
        });

        if (DB::table('tags')->count() === 0) {
            $defaultTagId = DB::table('tags')->insertGetId([
                'tag_ar' => 'افتراضي',
                'tag_en' => 'Default',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $defaultTagId = DB::table('tags')->first()->id;
        }

        DB::table('posts')->update(['tag_id' => $defaultTagId]);

        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('tag_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropColumn('tag_id');

            $table->string('tag_ar')->after('id');
            $table->string('tag_en')->after('tag_ar');
        });
    }
};
