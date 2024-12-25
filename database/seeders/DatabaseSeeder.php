<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\AboutCard;
use App\Models\Action;
use App\Models\Branch;
use App\Models\Career;
use App\Models\City;
use App\Models\ContactImage;
use App\Models\ContactInfo;
use App\Models\Fleet;
use App\Models\Hero;
use App\Models\Offer;
use App\Models\OurValue;
use App\Models\Section;
use App\Models\SocialLink;
use App\Models\Storage;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\VisionAndGoal;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'super',
        ]);

        Career::factory()->create();
        City::factory(5)->has(Branch::factory(2)->has(Offer::factory(5)))->create();

        $actions=[
            [
                'name_ar'=>'ايميل',
                'name_en'=>'Email',
            ],
            [
                'name_ar'=>'واتس اب',
                'name_en'=>'Whatsapp',
            ],
            [
                'name_ar'=>'اتصال',
                'name_en'=>'Call',

            ],
            [
                'name_ar'=>'رابط',
                'name_en'=>'Link',
            ],
        ];

        foreach ($actions as $action) {
            Action::query()->create($action);
        }

        Hero::factory(3)->create();
        OurValue::factory(5)->create();
        About::factory(1)->create();
        AboutCard::factory(6)->create();
        Section::factory(8)->create();
        VisionAndGoal::factory()->create([
            'slug' => 'vision',
        ]);
        VisionAndGoal::factory()->create([
            'slug' => 'goals',
        ]);

        Storage::factory()->create();
        Fleet::factory()->create();
        ContactImage::factory()->create([
            'slug' => 'image1',
            'view_title_ar'=>'الصورة الأولى',
            'view_title_en'=>'First Image',
        ]);
        ContactImage::factory()->create([
            'slug' => 'image2',
            'view_title_ar'=>'الصورة الثانية',
            'view_title_en'=>'Second Image',
        ]);


        SocialLink::factory()->create(
            [
                'title_ar'=>'تويتر(X)',
                'title_en'=>'Twitter(X)',
                'link'=>'https://x.com/',
            ]
        );
        SocialLink::factory()->create(
            [
                'title_ar'=>'فيس بوك',
                'title_en'=>'Facebook',
                'link'=>'https://facebook.com/',
            ]
        );
        SocialLink::factory()->create(
            [
                'title_ar'=>'يوتيوب',
                'title_en'=>'Youtube',
                'link'=>'https://youtube.com/',
            ]
        );
        SocialLink::factory()->create(
            [
                'title_ar'=>'انستجرام',
                'title_en'=>'Instagram',
                'link'=>'https://instagram.com/',
            ]
        );
        SocialLink::factory()->create(
            [
                'title_ar'=>'لينكدان',
                'title_en'=>'Linkedin',
                'link'=>'https://linkedin.com/',
            ]
        );
        SocialLink::factory()->create(
            [
                'title_ar'=>'واتساب',
                'title_en'=>'Whatsapp',
                'link'=>'https://whatsapp.com/',
            ]
        );
        SocialLink::factory()->create(
            [
                'title_ar'=>'سناب شات',
                'title_en'=>'Snapchat',
                'link'=>'https://snapchat.com/',
            ]
        );
        SocialLink::factory()->create(
            [
                'title_ar'=>'تيك توك',
                'title_en'=>'Tiktok',
                'link'=>'https://tiktok.com/',
            ]
        );
        SocialLink::factory()->create(
            [
                'title_ar'=>'قناة الواتساب',
                'title_en'=>'Whatsapp Channel',
                'link'=>'https://whatsapp.com/channel/',
            ]
        );

        ContactInfo::factory()->create(
            [
                'action_id' => 1,
                'content' => 'test@email.com',
            ]
        );

        ContactInfo::factory()->create(
            [
                'action_id' => 2,
                'content' => '0500000000',
            ]
        );

        ContactInfo::factory()->create(
            [
                'action_id' => 3,
                'content' => '0500000000',
            ]
        );

        ContactInfo::factory()->create(
            [
                'action_id' => 4,
                'content' => 'https://test.com',
            ]
        );
    }
}
