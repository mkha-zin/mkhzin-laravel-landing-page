<?php

namespace Database\Seeders;

use App\Models\StoreText;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreText::factory()->create([
            'key' => 'welcome text',
            'title_ar' => 'مرحباً بك في المتجر الإلكتروني',
            'title_en' => 'Welcome to our online store',
            'description_ar' => 'توفر شركة مخازن المملكة العالمية متجراً الكترونياً يسهل على عملائها طلب كل ما يحبون من أماكنهم دون الحاجة لتكبد عناء التسوق بالطريقة العادية.',
            'description_en' => 'We offer a wide range of online stores with an easy-to-use shopping experience.',
        ]);
        StoreText::factory()->create([
            'key' => 'categories text',
            'title_ar' => 'مرحباً بك في المتجر الإلكتروني',
            'title_en' => 'Welcome to our online store',
            'description_ar' => 'توفر شركة مخازن المملكة العالمية متجراً الكترونياً يسهل على عملائها طلب كل ما يحبون من أماكنهم دون الحاجة لتكبد عناء التسوق بالطريقة العادية.',
            'description_en' => 'We offer a wide range of online stores with an easy-to-use shopping experience.',
        ]);
        StoreText::factory()->create([
            'key' => 'download text',
            'title_ar' => 'مرحباً بك في المتجر الإلكتروني',
            'title_en' => 'Welcome to our online store',
            'description_ar' => 'توفر شركة مخازن المملكة العالمية متجراً الكترونياً يسهل على عملائها طلب كل ما يحبون من أماكنهم دون الحاجة لتكبد عناء التسوق بالطريقة العادية.',
            'description_en' => 'We offer a wide range of online stores with an easy-to-use shopping experience.',
        ]);
    }
}
