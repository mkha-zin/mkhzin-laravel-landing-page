<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'tag_ar' => 'تقنية',
                'tag_en' => 'Technology',
                'status' => 'active',
            ],
            [
                'tag_ar' => 'أعمال',
                'tag_en' => 'Business',
                'status' => 'active',
            ],
            [
                'tag_ar' => 'رياضة',
                'tag_en' => 'Sports',
                'status' => 'active',
            ],
            [
                'tag_ar' => 'صحة',
                'tag_en' => 'Health',
                'status' => 'active',
            ],
            [
                'tag_ar' => 'سفر',
                'tag_en' => 'Travel',
                'status' => 'active',
            ],
            [
                'tag_ar' => 'تعليم',
                'tag_en' => 'Education',
                'status' => 'active',
            ],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
