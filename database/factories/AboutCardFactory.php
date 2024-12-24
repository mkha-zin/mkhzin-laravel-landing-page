<?php

namespace Database\Factories;

use App\Models\AboutCard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AboutCard>
 */
class AboutCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_ar' => $this->faker->sentence(),
            'title_en' => $this->faker->sentence(),
            'description_ar' => $this->faker->paragraph(),
            'description_en' => $this->faker->paragraph(),
            'icon' => 'https://via.placeholder.com/50x50',
        ];
    }
}
