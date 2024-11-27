<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OurValue>
 */
class OurValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_ar'=>fake()->title,
            'title_en'=>fake()->title,
            'description_ar'=>fake()->text,
            'description_en'=>fake()->text,
            'icon'=>'https://via.placeholder.com/200x200',
            'image'=>'https://picsum.photos/200/300',
        ];
    }
}
