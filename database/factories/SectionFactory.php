<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
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
            'description_ar' => $this->faker->text,
            'description_en' => $this->faker->text,
            'image' => 'https://picsum.photos/200/300',
        ];
    }
}
