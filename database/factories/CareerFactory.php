<?php

namespace Database\Factories;

use App\Models\Career;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Career>
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
