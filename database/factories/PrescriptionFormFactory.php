<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrescriptionForm>
 */
class PrescriptionFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'medicine_name' => $this->faker->word,
            'per_day' =>  $this->faker->randomDigit,
            'duration' => $this->faker->randomDigit,
            'quantity' =>  $this->faker->randomDigit,
        ];

    }
}
