<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pharmacist>
 */
class PharmacistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'medicine_name' => $this->faker->name,
            'per_day' =>  $this->faker->randomDigit,
            'duration' => $this->faker->randomDigit,
            'total_quantity' =>  '23',
            'remarks' => $this->faker->word,
        ];
    }
}
