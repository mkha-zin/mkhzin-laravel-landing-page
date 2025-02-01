<?php

namespace Database\Seeders;

use App\Models\Header;
use Illuminate\Database\Seeder;

class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Header::factory()->create(
            [
                'key' => 'sections',
                'title_ar' => 'ترويسة صفحة الأقسام',
                'title_en' => 'Sections Page\'s Header',
                'image' => 'https://picsum.photos/200/300',
            ]
        );
        Header::factory()->create(
            [
                'key' => 'branches',
                'title_ar' => 'ترويسة صفحة الفروع',
                'title_en' => 'Branches Page\'s Header',
                'image' => 'https://picsum.photos/200/300',
            ]
        );
        Header::factory()->create(
            [
                'key' => 'contact-us',
                'title_ar' => 'ترويسة صفحة تواصل معنا',
                'title_en' => 'Contact Us Page\'s Header',
                'image' => 'https://picsum.photos/200/300',
            ]
        );
        Header::factory()->create(
            [
                'key' => 'offers',
                'title_ar' => 'ترويسة صفحة العروض',
                'title_en' => 'Offers Page\'s Header',
                'image' => 'https://picsum.photos/200/300',
            ]
        );
    }
}
