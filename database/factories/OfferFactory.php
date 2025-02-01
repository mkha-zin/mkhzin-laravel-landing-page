<?php

namespace Database\Factories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_ar' => $this->faker->name(),
            'name_en' => $this->faker->name(),
            'description_ar' => $this->faker->text(),
            'description_en' => $this->faker->text(),
            'image' => 'https://picsum.photos/200/300',
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
        ];
    }
}
