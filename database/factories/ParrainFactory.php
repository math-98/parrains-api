<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parrain>
 */
class ParrainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lastname' => fake()->lastName(),
            'firstname' => fake()->firstName(),
        ];
    }

    /**
     * Indicate that the person was absent.
     */
    public function absent(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'absent' => true,
            ];
        });
    }
}
