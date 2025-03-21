<?php

namespace Database\Factories;

use App\Http\Controllers\util\Common;
use App\Models\ContactImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactImage>
 */
class ContactImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => 'https://picsum.photos/200/300',
            'slug' => Common::createSlug(),
            'view_title_ar' => fake()->title(),
            'view_title_en' => fake()->title()

        ];
    }
}
