<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VisionAndGoal>
 */
class VisionAndGoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_ar' => fake()->sentence(),
            'title_en' => fake()->sentence(),
            'description_ar' => fake()->sentence(),
            'description_en' => fake()->sentence(),
            'image' => 'https://picsum.photos/300/300',
        ];
    }
}
