<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fleet>
 */
class FleetFactory extends Factory
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
            'description_en' => $this->faker->paragraph(),
            'image' => 'https://picsum.photos/640/480',
        ];
    }
}
