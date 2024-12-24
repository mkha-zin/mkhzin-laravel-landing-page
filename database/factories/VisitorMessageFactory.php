<?php

namespace Database\Factories;

use App\Models\VisitorMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VisitorMessage>
 */
class VisitorMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->email,
            'phone' => fake()->phoneNumber,
            'subject' => fake()->sentence,
            'message' => fake()->text,
        ];
    }
}
