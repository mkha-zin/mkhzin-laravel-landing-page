<?php

namespace Database\Factories;

use App\Models\VisionAndGoal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VisionAndGoal>
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
