<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voter>
 */
class VoterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->unique()->number(),
            'name' => $this->faker->name(),
            'class' => $this->faker->randomElement(['XII RPL 1', 'XII RPL 2', 'XII RPL 3', 'XII RPL 4']),
        ];
    }
}
