<?php

namespace Database\Factories;

use App\Models\JobsSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobsSettingFactory extends Factory
{
    protected $model = JobsSetting::class;

    public function definition(): array
    {
        return [
            'home_title_ar' => $this->faker->sentence(),
            'home_title_en' => $this->faker->sentence(),
            'home_description_ar' => $this->faker->sentence(),
            'home_description_en' => $this->faker->sentence(),
            'general_title_ar' => $this->faker->sentence(),
            'general_title_en' => $this->faker->sentence(),
            'general_description_ar' => $this->faker->sentence(),
            'general_description_en' => $this->faker->sentence(),
        ];
    }
}
