<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Storage>
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
