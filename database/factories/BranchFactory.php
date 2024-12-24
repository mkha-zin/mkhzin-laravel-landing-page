<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_ar'=> fake()->name,
            'name_en'=> fake()->name,
            'address_ar'=> fake()->address,
            'address_en'=> fake()->address,
            'image'=> 'https://picsum.photos/200/300',
        ];
    }
}
