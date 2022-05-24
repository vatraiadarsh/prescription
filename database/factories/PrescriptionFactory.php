<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'prescription_id' => $this->faker->uuid,
            'title' => $this->faker->word,
            'description' => $this->faker->word,
            'diagnosis' => $this->faker->word,
            'chronic_diagnosis' => $this->faker->word,
            'acute_diagnosis' => $this->faker->word,
            'social_history' => $this->faker->word,
            'post_medical_history' => $this->faker->word,
            'allergies' => $this->faker->word,
            'drug_allergies' => $this->faker->word,
            'food_allergies' => $this->faker->word,
            'medication' => $this->faker->word,
            'prescription' => $this->faker->word,
            'status' => $this->faker->randomElement(['on', 'off']),

        ];
    }
}
