<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Career>
 */
class CareerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_ar' => 'العنوان بالعربي',
            'title_en' => fake()->sentence(),
            'description_ar' => 'الوصف بالعربي',
            'description_en' => fake()->paragraph(),
            'email' => fake()->email,
            'image' => 'https://picsum.photos/200/300',
        ];
    }
}
