<?php

namespace Database\Factories;

use App\Models\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Storage>
 */
class StorageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_ar' => 'عنوان عربي',
            'title_en' => $this->faker->sentence(),
            'description_ar' => 'وصف عربي',
            'description_en' => $this->faker->sentence(),
            'background_image' => 'https://picsum.photos/300/300',
            'foreground_image' => 'https://picsum.photos/300/300',
        ];
    }
}
